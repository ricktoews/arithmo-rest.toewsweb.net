//==============================================================================
// Include required modules.
//==============================================================================
var express = require("express");
var bodyParser = require('body-parser');
var cors = require('cors');
var arithmo = require("arithmo");

//==============================================================================
// Start express framework.
//==============================================================================
var app = express();
app.use(express.static(__dirname + "/app"));
app.use(bodyParser.json());
app.use(cors());
var port = 8080;

//==============================================================================
// Route
//==============================================================================
app.get('/dc/:denom/:num?', getDecimalsForDenom);
app.get('/phi/:power', getPowersOfPhi);
app.get('/primes/:from/:to/:mod?', getListOfPrimes);
app.get('/factor/:n', getFactorsOfN);

exports.app = app;
if (!module.parent) {
    app.listen(8080);
    console.log("I'm listening.");
}


//------------- Handlers ---------------
function getDecimalsForDenom(req, res) {
    var denom = req.params.denom;
    var num = req.params.num;
    var data = arithmo.decimals(denom, num);
    res.json(data);
}

function getPowersOfPhi(req, res) {
    var power = req.params.power;
    var data = arithmo.phiPowers(power);
    res.json(data);
}

function getListOfPrimes(req, res) {
    var from = req.params.from;
    var to = req.params.to;
    var mod = req.params.mod || null;
    var data = arithmo.listPrimes(from, to, mod);
    res.json(data);
}

function getFactorsOfN(req, res) {
    var n = req.params.n;
    var data = arithmo.factor(n);
    res.json(data);
}

