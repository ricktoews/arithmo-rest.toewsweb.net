Array.prototype.clone = function() { return this.slice(0); };

/*
 * Krypto card deck, shuffling and dealing methods
 */
var K = (function() {
    var _cards = [1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4, 5, 5, 5, 6, 6, 6, 7, 7, 7, 8, 8, 8, 9, 9, 9, 10, 10, 10,
            11, 11, 12, 12, 13, 13, 14, 14, 15, 15, 16, 16, 17, 17, 
            18, 19, 20, 21, 22, 23, 24, 25];

    var _shuffleDeck = function() {
        var _tmpCards = _cards.clone();
        var _shuffled = [];
        for (var i = 0, j = _cards.length; i < j; i++) {
            var _cardsRemaining = j - i;
            var _ndx = Math.floor(Math.random() * _cardsRemaining);
            _shuffled.push(_tmpCards[_ndx]);
            _tmpCards[_ndx] = _tmpCards[_cardsRemaining - 1];
            _tmpCards.splice(_cardsRemaining - 1, 1);
        }
        return _shuffled;
    };


    return {
        moreHands: true,

        initGame: function() {
            this.deck = _shuffleDeck();
        },

        getHand: function() {
            var _hand = this.deck.slice(0, 6);
            this.deck.splice(0, 6);
            this.moreHands = this.deck.length >= 6;
            return _hand;
        }

    };
})();


/*
 * Device-specific output.  Contains HTML code.
 */
var D = (function() {
    var _position = 1;
    var _solution = [];
    var _operators = [];
    var _objective;

    var _clearBoard = function() {
        _position = 1;
        _solution = [];
        _operators = [];
        $('.my-solution li').find('.ui-btn-text').html('');
        D.activateButtons();
    };

    var _evaluate = function(a, b, op) {
        switch (op) {
            case '+':
                return 1*a+1*b;
                break;
            case '-':
                return a-b;
                break;
            case 'x':
                return a*b;
                break;
            case '/':
                return a/b;
                break;
        }
    };

    return {
        activateButtons: function() {
            $('.hand li').click(function(e) {
                var _el = $(this).find('.ui-btn-text');
                var _num = _el.html();
                if (_position % 2 == 1 && _position <= 9) {
                    $('.my-solution li:nth-child('+_position+')').find('.ui-btn-text').html(_num);
                    _solution.push(_num);
                    _position++;
                }
//                $(this).unbind('click');
            });

            $('.operators li').click(function(e) {
                var _el = $(this).find('.ui-btn-text');
                var _op = _el.html();
                if (_position % 2 == 0 && _position < 9) {
                    $('.my-solution li:nth-child('+_position+')').find('.ui-btn-text').html(_op);
                    _operators.push(_op);
                    _position++;
                }
            });

            $('#solution').click(function(e) {
                console.log(_solution);
                console.log(_operators);
                var _result = _solution[0];
                for (var i = 0, j = _operators.length; i < j; i++) {
                    _result = _evaluate(_result, _solution[i+1], _operators[i]);
                }
                $('.my-result').html(_result);
                if (_result == _objective) {
                    console.log("Got it!");
                    if (K.moreHands) {
                        _clearBoard();
                        currentHand = K.getHand();
                        D.showHand(currentHand);
                    }
                }
            });

            $('.reset').click(function(e) {
                _clearBoard();
            });

            $('.undo').click(function(e) {
                _position--;
                $('.my-solution li:nth-child('+_position+')').find('.ui-btn-text').html('');
                if (_position % 2 == 0) {
                    _operators.pop();
                } 
                else {
                    _solution.pop();
                }
            });
        },


        showHand: function(hand) {
            var _cards = [];
            for (var i = 0; i < 5; i++) {
                $('.hand li:nth-child('+(i+1)+') .ui-btn-text').html(hand[i]);
            }
            _objective = hand[5];
            $('.objective .ui-btn-text').html(_objective);
        }
    };
})();

$(function() {
    D.activateButtons();
    K.initGame();
//    while (K.moreHands) {
        currentHand = K.getHand();
        D.showHand(currentHand);
//    }
});
