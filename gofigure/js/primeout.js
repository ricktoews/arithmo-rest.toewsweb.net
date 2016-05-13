var makeSprite = function(n, color, isprime) {
    var el = document.createElement('div');

    el.className = 'item';
    $(el)
        .html(n)
        .css('background-color', color).attr({ 'data-prime': isprime, 'data-num': n })
        .click(function(e) { 
            // normalize
            var e = e || window.event;
            PrimeOut.hit(e); 
        });

    return {
        sprite: el,

        placeSprite: function() {
            var coords = PrimeOut.getCoords();

            var vPos = coords.y + 'px';
            var hPos = coords.x + 'px';
            $(this.sprite).css({top:vPos, left:hPos});
            $(PrimeOut.field).append(this.sprite);
        },

        dance: function() {
            var coords = PrimeOut.getCoords();
            var vDest = coords.y;
            var hDest = coords.x;
            var that = this;

            $(this.sprite)
            .animate(
                {
                    top: vDest,
                    left: hDest
                },
                Math.ceil(Math.random(100)) * 3000,
                function() { that.dance(); }
            )
            ;
        },

        terminus:1
    };
};


var PrimeOut = {
    sprites: [],
    primeInPlay: 1,
    composInPlay: 5,
    field: '#field',
    colors: ['#f90', '#09f', '#90f', '#f09', '#9f0', '#0f9'],
    primes: [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97],
    composites: [],
    penalties: 0,
    successes: 0,
    spriteRoll: {},

    initComposites: function() {
        for (var i = 4; i < 100; i++) {
            if ($.inArray(i, this.primes) == -1) {
                this.composites.push(i);
            }
        }
    },

    freezeSprites: function() {
        for (var i = 0, j = this.sprites.length; i < j; i++) {
            $(this.sprites[i].el.sprite).stop();
        }
    },

    addHomeRun: function() {
        $('#homeruns li:nth-child('+this.successes+')').css('background-color', 'green');
    },

    addOut: function() {
        $('#outs li:nth-child('+this.penalties+')').css('background-color', 'red');
    },

    hit: function(e) {
        var target = e.target || e.srcElement;
        // for IE9, which doesn't include the dataset property.
        var num = target.dataset ? target.dataset.num : target.getAttribute('data-num');
        var primeFlag = target.dataset ? target.dataset.prime : target.getAttribute('data-prime');
        var hitPrime = parseInt(primeFlag);
        if (hitPrime) {
            $(target).css('background-color','#e00');
            this.penalize();
            this.addOut();
            this.freezeSprites();
            popup('#miss');
            $('#overlay').click(function() { $('#overlay').hide(); $('#miss').hide(); PrimeOut.initField(); });
//            this.initField();
        }
        else {
            $(target).css('background-color','#aaa');
        }
        $(target).stop();
        this.checkRemainingSprites(num);
    },

    clearField: function() {
        this.spriteRoll = {};
        $(this.field).html('');
    },

    initField: function() {
        this.clearField();
        var sprites = this.selectNumbers();
        for (var i = 0, j = sprites.length; i < j; i++) {
            sprites[i].el.placeSprite();
            sprites[i].el.dance();
        }
        this.sprites = sprites;
    },

    selectNumbers: function() {
        var tmpPrimes = this.primes.slice();
        var tmpComposites = this.composites.slice();
        var tmpColors = this.colors.slice();
        var items = [];
        for (var i = 0; i < this.primeInPlay; i++) {
            var ndx = Math.floor(Math.random() * tmpPrimes.length);
            var colorNdx = Math.floor( Math.random() * tmpColors.length );
            var prime = tmpPrimes[ndx];
            var color = tmpColors[colorNdx];

            var el = new makeSprite(prime, color, 1);
            tmpColors.splice(colorNdx, 1);
            items.push({num:prime, el:el});
            this.spriteRoll[prime] = 1;
        }
        for (var i = 0; i < this.composInPlay; i++) {
            var ndx = Math.floor(Math.random() * tmpComposites.length);
            var colorNdx = Math.floor( Math.random() * tmpColors.length );
            var compos = tmpComposites[ndx];
            var color = tmpColors[colorNdx];

            var el = new makeSprite(compos, color, 0);
            tmpComposites.splice(ndx, 1);
            tmpColors.splice(colorNdx, 1);
            items.push({num:compos, el:el});
            this.spriteRoll[compos] = 1;
        }
        return items;
    },

    getCoords: function() {
        var vPos = Math.ceil( Math.random() * ( $(this.field).height() - 100) );
        var hPos = Math.ceil( Math.random() * ( $(this.field).width() - 100) );
        return {x: hPos, y: vPos};
    },

    checkRemainingSprites: function(n) {
        if (this.spriteRoll[n]) {
            delete this.spriteRoll[n];
        }
        var count = 0;
        for (k in this.spriteRoll) {
            count++;
        }
        if (count == 1) {
            this.reward();
            this.addHomeRun();
            if (this.successes < 3) {
//                setTimeout('PrimeOut.initField()', 2000);
                this.freezeSprites();
                popup('#hit');
                $('#overlay').click(function() { $('#overlay').hide(); $('#hit').hide(); PrimeOut.initField(); });
            }
            else {
                popup('#finished');
                this.freezeSprites();
            }
        }
        if (this.penalties == 3) {
            popup('#drawingboard');
            this.freezeSprites();
        }
    },

    penalize: function() {
        this.penalties++;
    },

    reward: function() {
        this.successes++;
    },

    isPrime: function(n) {
        
    }
};

$(document).ready(function() {
    PrimeOut.initComposites();
    PrimeOut.initField();
});

