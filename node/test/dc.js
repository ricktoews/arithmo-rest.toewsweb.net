// Use Should for testing.
var should = require("should");

// Module to be tested
var arithmo = require("arithmo");

describe("Decimal calculator tests", function() {
    it("should return rows corresponding to denominator - 1", function(done) {
        var data = arithmo.decimals(5);
        data.should.have.length(4);
        done();
    });

    it("should have properties to describe the period", function(done) {
        var data = arithmo.decimals(14);
        var parts = data[0].decimal.parts;
        parts.should.have.length(3);
        parts[0].should.equal("0").and.be.a.String;
        parts[1].should.equal("714").and.be.a.String;
        parts[2].should.equal("285").and.be.a.String;
        done();
    });
});
