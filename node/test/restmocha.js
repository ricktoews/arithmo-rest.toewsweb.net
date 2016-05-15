var http = require("http");
var should = require("should");
var app = require(__dirname + "/../server.js").app;
var port = 3333;
var sessionCookie = null;

function defaultGetOptions(path) {
    var options = {
        "host": "localhost",
        "port": port,
        "path": path,
        "method": "GET",
        "headers": {
            "Cookie": sessionCookie
        }
    };
    return options;
}


describe("app", function () {
 
    before(function (done) {
        app.listen(port, function (err, result) {
            if (err) {
                done(err);
            } else {
                done();
            }
        });
    });

    after(function (done) {
//        app.close();
        done();
    });

    it('should exist', function (done) {
        should.exist(app);
        done();
    });

    it('should be listening at localhost:3333', function (done) {
        var headers = defaultGetOptions('/hello');
        http.get(headers, function (res) {
            res.statusCode.should.eql(404);
            done();
        });
    });

    it("should be able to get powers of phi", function(done) {
        var headers = defaultGetOptions("/phi/5");
        http.get(headers, function (res) {
            res.statusCode.should.eql(200);
            done();
        });
    });
/* 
    it('should authenticate a user', function (done) {
        var qstring = JSON.stringify({
            userid: testuserParams.login,
            password: testuserParams.password
        });

        var options = defaultPostOptions('/login', qstring);
        var req = http.request(options, function (res) {
        sessionCookie = res.headers['set-coookie'][0];
        res.ond('data', function (d) {
            var body = JSON.parse(d.toString('utf8'));
            body.should.have.property('message').and.match(/logged in/);
            accountId = body.account.id;
            done();
        });

        req.write(qstring);
        req.end();
    });
*/
});
