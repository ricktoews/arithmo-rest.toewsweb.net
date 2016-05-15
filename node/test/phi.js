var arithmo = require("arithmo");
//var should = require("should");
var expect = require("chai").expect;

// 1.618033988749895;

describe("Test phi functionality", function() {
    var data,
        firstPower;

    before(function(done) {
        data = arithmo.phiPowers(2);
        firstPower = data[0];
        done();
    });

    it("should contain the string rink", function(done) {
        expect("A Wrinkle In Time").to.have.string("rink");
        done();
    });

    it("should contain various keys", function(done) {
        expect(firstPower).to.contain.keys("whole", "power", "sqrt_5_coef", "denom", "real_value");
        done();
    });

    it("should return two rows of phi powers", function(done) {
        expect(data).to.have.length(2);
        done();
    });

    it("should contain a phiPowers method", function(done) {
        expect(arithmo).to.respondTo("phiPowers");
        done();
    });

    it("should include the correct numerator values", function(done) {
        expect(firstPower).to.have.property("whole");
        expect(firstPower).to.have.property("sqrt_5_coef");
        done();
    });

    it("should include an approximation of the phi power", function(done) {
        var real = Math.floor(firstPower) / 1000;
        var phi = firstPower["real_value"];
        expect(phi).to.satisfy(function(n) { return n > 1.618 && n < 1.6181; });
        expect(phi).to.be.closeTo(1.618, .0001);
        done();
    });
});


