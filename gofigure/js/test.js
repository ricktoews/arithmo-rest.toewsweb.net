var makeSprite = function(seq, color) {

    var getGCF = function(a, b) {
        var gcf = 0;
        while (gcf == 0) {
            if (Math.max(a, b) % Math.min(a, b) == 0) {
                gcf = Math.min(a, b);
            }
            else {
                if (b > a) {
                    b = b - a;
                }
                else {
                    a = a - b;
                }
            }
        }
        return gcf;
    };

    var chooseDenominator = function() {
        var d = Math.ceil(Math.random() * 48) + 3;
        var rp = [];

        for (var i = 2; i < d; i++) {
            if (getGCF(i, d) == 1) {
                rp.push(i);
            }
        }
        return { denominator: d, relativePrimes: rp };
    };

    var chooseNumerator = function(dObj) {
        
        var nNdx = Math.floor(Math.random() * dObj.relativePrimes.length);
        var n = dObj.relativePrimes[nNdx];
        return n;
    };

    var choosePrimes = function() {
        var quantity = Math.floor(Math.random() * 5);
        var bulkList = [];
        var bulk = 1;
        for (var i = 0; i < quantity; i++) {
            var pNdx = Math.floor(Math.random() * 3);
            bulkList.push(Reductio.primes[pNdx]);
            bulk *= Reductio.primes[pNdx];
        }
        return { bulk: bulk, bulkList: bulkList };
    };

    var craftFraction = function() {
        var dObj = chooseDenominator();
        var n = chooseNumerator(dObj);
        var bulkObj = choosePrimes();
        return { numerator:n, denominator:dObj.denominator, bulk:bulkObj.bulk, bulkList:bulkObj.bulkList };
    };

    var buildElement = function() {
        var el = document.createElement('div');
        var elWin = document.createElement('div');
        var elLose = document.createElement('div');
        var divNum = document.createElement('div');
        var divDenom = document.createElement('div');
        el.className = 'fraction';
        elWin.className = 'win';
        elLose.className = 'lose';
        divNum.className = 'numerator';
        divDenom.className = 'denominator';
        $(elLose).html('<p>X</p>');
        $(divNum).html(fract.bulk * fract.numerator);
        $(divDenom).html(fract.bulk * fract.denominator);
        var leftPos = (Reductio.leftOffset + seq * Reductio.spriteWidth) + 'px';
        $(el)
            .append(elWin)
            .append(elLose)
            .append(divNum)
            .append(divDenom)
            .css({'background-color': color, 'top': '100px', 'left':leftPos})
            .click(function() {
                checkFinished(this);
            })
            .droppable({
                drop:function() {
                    clearDropPotential(this);
                    checkFactor(this, Reductio.currentPrime);
                },
                over:function() {
                    detectDropPotential(this);
                },
                out:function() {
                    clearDropPotential(this);
                }
            })
            ;
        return { main:el, win:elWin, lose:elLose, num:divNum, denom:divDenom };
    };

    var detectDropPotential = function(el) {
        $(el).css({'opacity':'.5'});
    };

    var clearDropPotential = function(el) {
        $(el).css({'opacity':'1'});
    };

    var checkFactor = function(el, p) {
        if (fract.bulk % p == 0) {
            fract.bulk /= p;
            $(sprite.num).html(fract.bulk * fract.numerator);
            $(sprite.denom).html(fract.bulk * fract.denominator);
        }
        else {
            $(sprite.lose).show();
            cauterizeSprite(el, -1);
        }
    };

    var checkFinished = function(el) {
        if (fract.bulk == 1) {
            $(sprite.win).show();
            cauterizeSprite(el, 1);
        }
        else {
            $(sprite.lose).show();
            cauterizeSprite(el, -1);
        }
    };

    var cauterizeSprite = function(el, val) {
        $(el).droppable('destroy');
        $(el).unbind('click');
        if (val == -1) {
            Reductio.penalties++;
        }
        else {
            Reductio.successes++;
        }
        var total = Reductio.successes + Reductio.penalties;
        if (total >= Reductio.maxFractions) {
            msg = document.createElement('p');
            $(msg).html('Correct: ' + Reductio.successes + '; Missed: ' + Reductio.penalties);
            $('#finished').append(msg);
            popup('#finished');
        }
    };

    var fract = craftFraction();
    var sprite = buildElement();

    return {
        fraction: fract,

        sprite: sprite.main,

        placeSprite: function() {
            var coords = Reductio.getCoords();

            var vPos = coords.y + 'px';
            var hPos = coords.x + 'px';
            $(this.sprite).css({top:vPos, left:hPos});
            $(Reductio.field).append(this.sprite);
        },

        terminus:1
    };
};


var Reductio = {
    sprites: [],
    spriteWidth: 150,
    leftOffset: 40,
    field: '#field',
    colors: ['#f90', '#09f', '#90f', '#f09', '#9f0', '#0f9'],
    primes: [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97],
    composites: [],
    maxFractions: 5,
    maxPrimeTiles: 3,
    primeTileWidth: 50,
    penalties: 0,
    successes: 0,

    makePrimeTile: function(p) {
        var t = document.createElement('div');
        t.className = 'primetile';
        $(t)
            .html(p)
            .draggable({
                opacity:.7,
                zIndex:1000,
                revert:true,
                start: function(event, ui) { Reductio.currentPrime = p; }
            })
        ;

        return t;
    },

    initComposites: function() {
        for (var i = 4; i < 100; i++) {
            if ($.inArray(i, this.primes) == -1) {
                this.composites.push(i);
            }
        }
    },

    addHomeRun: function() {
        $('#homeruns li:nth-child('+this.successes+')').css('background-color', 'green');
    },

    addOut: function() {
        $('#outs li:nth-child('+this.penalties+')').css('background-color', 'red');
    },

    clearField: function() {
        this.spriteRoll = {};
        $(this.field).html('');
    },

    initField: function() {
        this.clearField();
        var sprites = this.setupFractions();
        var primeTiles = this.primeTiles();
        for (var i = 0, j = sprites.length; i < j; i++) {
            $(this.field).append(sprites[i].sprite.sprite);
        }
        this.sprites = sprites;
    },

    primeTiles: function() {
        var tiles = [];
        for (var i = 0; i < this.maxPrimeTiles; i++) {
            var pt = this.makePrimeTile(this.primes[i]);
            $(pt).css({'position': 'absolute', 'height': this.primeTileWidth + 'px', 'width' : this.primeTileWidth + 'px', 'left': (this.leftOffset+70*i)+'px'});
            $(this.field).append(pt);
            tiles.push(pt);
        }
        return tiles;
    },

    setupFractions: function() {
        var items = [];
        var tmpColors = Reductio.colors.slice();

        for (var i = 0; i < this.maxFractions; i++) {
            var colorNdx = Math.floor( Math.random() * tmpColors.length );
            items.push({sprite:makeSprite(i, tmpColors[colorNdx])});
            tmpColors.splice(colorNdx, 1);
        }
        return items;
    },

    getCoords: function() {
        var vPos = Math.ceil( Math.random() * ( $(this.field).height() - 100) );
        var hPos = Math.ceil( Math.random() * ( $(this.field).width() - 100) );
        return {x: hPos, y: vPos};
    },

    penalize: function() {
        this.penalties++;
        this.initField();
    },

    reward: function() {
        this.successes++;
    },

    isPrime: function(n) {
        
    }
};

$(document).ready(function() {
    Reductio.initComposites();
    Reductio.initField();
});

