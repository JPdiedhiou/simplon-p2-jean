describe("AppActivityHandler test", function() {
    var clock;
    beforeEach(function () {
        clock = sinon.useFakeTimers("Date", "setTimeout", "clearTimeout");
    });

    afterEach(function () {
        clock.restore();
    });

    it("Initial setup", function() {
        var calls = 0;
        var keepAlive = new KeepAlive(10000, function() {
            calls++;
        });
        expect(calls).to.eql(0);
        keepAlive.destroy();
        clock.tick(10100);
        expect(calls).to.eql(0);
    });
    it("One tick", function() {
        var calls = 0;
        var keepAlive = new KeepAlive(10000, function() {
            calls++;
        });
        expect(calls).to.eql(0);
        clock.tick(10100);
        expect(calls).to.eql(1);
        keepAlive.destroy();
        clock.tick(10100);
        expect(calls).to.eql(1);
    });

    it("Two ticks", function() {
        var calls = 0;
        var keepAlive = new KeepAlive(10000, function() {
            calls++;
        });
        expect(calls).to.eql(0);
        clock.tick(10100);
        expect(calls).to.eql(1);
        clock.tick(10100);
        expect(calls).to.eql(2);
        keepAlive.destroy();
        clock.tick(10100);
        expect(calls).to.eql(2);
    });
});
