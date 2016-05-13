<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript" src="/js/jquery-1.6.4.js"></script>
    <script type="text/javascript">
        var Sprite = function() {
            
        };

        var PrimeOut = {
            primeInPlay: 1,
            composInPlay: 5,
            colors: ['#f90', '#09f', '#90f', '#f09', '#9f0', '#0f9'],
            primes: [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97],
            composites: [],

            initComposites: function() {
                for (var i = 4; i < 100; i++) {
                    if ($.inArray(i, this.primes) == -1) {
                        this.composites.push(i);
                    }
                }
            },

            createNumElement: function(n, isprime) {
                var el = document.createElement('div');
                el.className = 'item';
                $(el).html(n).attr('data-prime', isprime);
                return el;
            },

            initField: function() {
                items = this.selectNumbers();
                this.placeNumbers(items);
                this.startDance(items);
            },

            selectNumbers: function() {
                var tmpPrimes = this.primes;
                var tmpComposites = this.composites;
                var items = [];
                for (var i = 0; i < this.primeInPlay; i++) {
                    var ndx = Math.floor(Math.random() * tmpPrimes.length);
                    var el = this.createNumElement(tmpPrimes[ndx], 1);
                    items.push({num:tmpPrimes[ndx], el:el, prime:true});
                }
                for (var i = 0; i < this.composInPlay; i++) {
                    var ndx = Math.floor(Math.random() * tmpComposites.length);
                    var el = this.createNumElement(tmpComposites[ndx], 0);
                    items.push({num:tmpComposites[ndx], el:el, prime:false});
                }
                return items;
            },

            placeNumbers: function(items) {
                for (var i = 0, j = items.length; i < j; i++) {
                    var vPos = Math.ceil( Math.random() * ( $('#field').height() - 100) ) + 'px';
                    var hPos = Math.ceil( Math.random() * ( $('#field').width() - 100) ) + 'px';
                    var color = Math.floor( Math.random() * this.colors.length );
                    $(items[i].el).css({top:vPos, left:hPos, color:'white', background:this.colors[color]});
                    $('#field').append(items[i].el);
                }
            },
 
            startDance: function(items) {
                for (var i = 0, j = items.length; i < j; i++) {
                    PrimeOut.numberDance(items[i].el);
                }
            },

            numberDance: function(n) {
                var vDest = Math.ceil( Math.random() * ( $('#field').height() - 100));
                var hDest = Math.ceil( Math.random() * ( $('#field').width() - 100));

                $(n).animate(
                    {
                        top: vDest,
                        left: hDest
                    },
                    Math.ceil(Math.random(100)) * 3000,
                    function() { PrimeOut.numberDance(n); }
                )
                .click(PrimeOut.hit);
            },

            hit: function() {
                var hitPrime = parseInt(this.dataset.prime);
                if (hitPrime) {
                    $('#msg').show();
                }
                $(this).stop();
            },

            isPrime: function(n) {
                
            }
        };

        $(document).ready(function() {
            PrimeOut.initComposites();
            PrimeOut.initField();
        });

    </script>
    <style type="text/css">
        .item {
            font:48pt verdana;
            color:#0099ff;
            position:absolute;
            width:95px;
            height:95px;
            border:1px solid gray;
            text-align:center;
            cursor:pointer;
        }
        #field {
            position:relative;
            width:800px;
            height:600px;
            margin:auto;
            background:#eee;
        }
        #msg_box {
            position:relative;
            margin:auto;
            width:800px;
            height:100px;
        }
        #msg {
            text-align:center;
            font:16pt arial;
            color:#333;
            display:none;
        }
    </style>
</head>
<body>
<div id="msg_box"><span id="msg">Ouch!</span></div>
<div id="field"></div>
</body>
</html>
