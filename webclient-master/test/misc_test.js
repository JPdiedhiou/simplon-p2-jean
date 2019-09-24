/**
 *  If progress was called right away when the SpeedMeter object
 *  was created (only reproducible if you have a very fast
 *  internet connection) it ended up dividing the speed by 0 (which is Infinity).
 */
describe("test speedmeter bug with fast connections", function() {
    'use strict';

    it("doesn't show Infinity", function(next) {
        var sp = new SpeedMeter(function() {});
        var mb5 = 5 * 1024 * 1024;
        sp.progress(0, mb5 * 5);
        assert(sp.getData().speed.match(/infin/i) === null);
        for (i = 0; i < 500; ++i) {
            sp.progress(i * 2, mb5 * 5);
            assert(sp.getData().speed.match(/infin/i) === null);
        }
        var i = 0;
        var tick = setInterval(function() {
            sp.progress(mb5*(++i));
            assert(sp.getData().speed.match(/infin/i) === null);
            if (i == 5) {
                clearInterval(tick);
                next();
            }
        }, 100);
    });
});

describe("Test array.* methods", function() {
    'use strict';
    var assert = chai.assert;

    it("can convert to object", function() {
        var a = array.to.object([1, 2, 3, 4, 5, 6, 0]);

        assert.strictEqual(JSON.stringify(a), '{"0":7,"1":1,"2":2,"3":3,"4":4,"5":5,"6":6}');
    });

    it("can obtain random value", function() {
        var a = [123, 6785, 'fas', 23, 'poex'];
        var r = array.random(a);

        expect(a.indexOf(r)).to.greaterThan(-1);
    });

    it("can obtain unique array", function() {
        var a = array.unique([1, Math.pow(2, 32), 2, 3, 4, 4, Math.pow(2, 32), 4, 5]);

        assert.strictEqual(JSON.stringify(a), '[1,4294967296,2,3,4,5]');
    });

    it("can remove value", function() {
        var a = [6, 5, 3, 6, 7, 9, 4, 9];
        var r = array.remove(a, 6);

        assert.strictEqual(r, true);
        assert.strictEqual(JSON.stringify(a), '[5,3,6,7,9,4,9]');
    });

    it("can pack and unpack", function() {
        var a = ['', '', '1', '2', '1', '2', '4', '4', '4', '0', '', '0', '', '6'];
        var p = array.pack(a);
        var u = array.unpack(p);

        assert.strictEqual(p, '*2,1>2*2,4*3,0>*2,6');
        assert.strictEqual(JSON.stringify(a), JSON.stringify(u));
    });
});
