/**
 * @fileOverview
 * Chat message encryption unit tests.
 */

describe("chat.strongvelope unit test", function() {
    var assert = chai.assert;
    var ns = strongvelope;

    // Some test data.
    var PROTOCOL_VERSION_STRING = "\u0001";
    var PROTOCOL_VERSION_V0 = 0;
    var PROTOCOL_VERSION_V1 = 1;
    var ED25519_PRIV_KEY = atob('nWGxne/9WmC6hEr0kuwsxERJxWl7MmkZcDusAxyuf2A=');
    var ED25519_PUB_KEY = atob('11qYAYKxCrfVS/7TyWQHOg7hcvPapiMlrwIaaPcHURo=');
    var CU25519_PRIV_KEY = atob('ZMB9oRI87iFj5cwKBvgzwnxxToRAO3L5P1gILfJyEik=');
    var CU25519_PUB_KEY = atob('4BXxF+5ehQKKCCR5x3hP3E0hzYry59jFTM30x9dzWRI=');
    var RSA_PUB_KEY = [
        asmCrypto.base64_to_bytes('wT+JSBnBNjgalMGT5hmFHd/N5eyncAA+w1TzFC4PYfB'
            + 'nbX1CFcx6E7BuB0SqgxbJw3ZsvvowsjRvuo8SNtfmVIz4fZV45pBPxCkeCWonN/'
            + 'zZZiT3LnYnk1BfnfxfoXtEYRrdVPXAC/VDc9cgy29OXKuuNsREKznb9JFYQUVH9'
            + 'FM='),
        asmCrypto.base64_to_bytes('AQAB')
    ];
    var RSA_PRIV_KEY = [
        asmCrypto.base64_to_bytes('wT+JSBnBNjgalMGT5hmFHd/N5eyncAA+w1TzFC4PYfB'
            + 'nbX1CFcx6E7BuB0SqgxbJw3ZsvvowsjRvuo8SNtfmVIz4fZV45pBPxCkeCWonN/'
            + 'zZZiT3LnYnk1BfnfxfoXtEYRrdVPXAC/VDc9cgy29OXKuuNsREKznb9JFYQUVH9'
            + 'FM='),
        65537,
        asmCrypto.base64_to_bytes('B1SXqop/j8T1DSuCprnVGNsCfnRJra/0sYgpaFyO7NI'
            + 'nujmEJjuJbfHFWrU6GprksGtvmJb4/emLS3Jd6IKsE/wRthTLLMgbzGm5rRZ92g'
            + 'k8XGY3dUrNDsnphFsbIkTVl8n2PX6gdr2hn+rc2zvRupAYkV/smBZX+3pDAcuHo'
            + '+E='),
        asmCrypto.base64_to_bytes('7y+NkdfNlnENazteobZ2K0IU7+Mp59BgmrhBl0TvhiA'
            + '5HkI9WJDIZK67NsDa9QNdJ/NCfmqE/eNkZqFLVq0c+w=='),
        asmCrypto.base64_to_bytes('ztVHfgrLnINsPFTjMmjgZM6M39QEUsi4erg4s2tJiuI'
            + 'v29szH1n2HdPKFRIUPnemj48kANvp5XagAAhOb8u2iQ=='),
        asmCrypto.base64_to_bytes('IniC+aLVUTonye17fOjT7PYQGGZvsqX4VjP51/gqYPU'
            + 'h5jd7qdjr2H7KImD27Vq3wTswuRFW61QrMxNJzUsTow=='),
        asmCrypto.base64_to_bytes('TeoqNGD8sskPTOrta1/2qALnLqo/tq/GTvR255/S5G6'
            + 'weLHqYDUTcckGp0lYNu/73ridZ3VwdvBo9ZorchHbgQ=='),
        asmCrypto.base64_to_bytes('JhqTYTqT5Dj6YoWHWNHbOz24NmMZUXwDms/MDOBM0Nc'
            + '0nX6NjLDooFrJZtBMGMgcSQJd4rULuH94+szNGc2GAg==')
    ];
    var KEY = atob('/+fPkTwBddDWDSA2M1hluA==');
    var NONCE = atob('MTHgl79y+1FFnmnopp4UNA==');
    var KEY_ID = atob('QUkAAA==');
    var INITIAL_MESSAGE_BIN = atob('AQEAAECuKE3arE92KkMXAdaUtbZ1riLfiLezTBFtB'
        + 'kZMNqNYsV402eiU2T8UN8AZPthbKkIsx7DwnhBJ2aBrvjnoF4UDAgAAAQADAAAM71B'
        + 'rlkBJXmR5xRtMBAAACMqLuOeu/PccBQAAEMiaxjj3mLwIOIk3mKluzXsGAAAEQUkAA'
        + 'AcAAAbruWm1K5g=');
    var INITIAL_KEY_MESSAGE_BIN = atob('AQEAAECuKE3arE92KkMXAdaUtbZ1riLfiLezTBFtB'
        + 'kZMNqNYsV402eiU2T8UN8AZPthbKkIsx7DwnhBJ2aBrvjnoF4UDAgAAAQADAAAM71B'
        +  'rlkBJXmR5xRtMBAAACMqLuOeu/PccBQAAEMiaxjj3mLwIOIk3mKluzXsGAAAEQUkAA'
        +  'A==');
    var INITIAL_MESSAGE_BODY_BIN = atob('AwAADO9Qa5ZASV5kecUbTAQAAAjKi7jnrvz3'
        + 'HAUAABDImsY495i8CDiJN5ipbs17BgAABEFJAAAHAAAG67lptSuY');
    var INITIAL_KEY_MESSAGE_BODY_BIN = atob('AwAADO9Qa5ZASV5kecUbTAQAAAjKi7jnrvz3'
        + 'HAUAABDImsY495i8CDiJN5ipbs17BgAABEFJAAA=');
    var INITIAL_MESSAGE = {
        protocolVersion: 1,
        signature:  atob('rihN2qxPdipDFwHWlLW2da4i34i3s0wRbQZGTDajWLFeNNnolNk'
            + '/FDfAGT7YWypCLMew8J4QSdmga7456BeFAw=='),
        signedContent: atob('AgAAAQADAAAM71BrlkBJXmR5xRtMBAAACMqLuOeu/PccBQAA'
            + 'EMiaxjj3mLwIOIk3mKluzXsGAAAEQUkAAAcAAAbruWm1K5g='),
        type: 0x00,
        nonce: atob('71BrlkBJXmR5xRtM'),
        recipients: ['you456789xw'],
        keys: [atob('yJrGOPeYvAg4iTeYqW7New==')],
        keyIds: [KEY_ID],
        includeParticipants: [],
        excludeParticipants: [],
        payload: atob('67lptSuY')
    };
    var FOLLOWUP_MESSAGE_BIN = atob('AQEAAECXRUab/B0G4OStZoUk3fmgbSmaKptYdbbTK'
        + 'Zh4GVmbB14Rn/xSR9zYypOXD7MgNRJCAFjDZ/3scsGNZTqAewgDAgAAAQEDAAAM71Br'
        + 'lkBJXmR5xRtMBgAABEFJAAAHAAAG67lptSuY');
    var FOLLOWUP_MESSAGE_BODY_BIN = atob('AwAADO9Qa5ZASV5kecUbTAYAAARBSQAABwAA'
        + 'Buu5abUrmA==');
    var FOLLOWUP_MESSAGE = {
        protocolVersion: 1,
        signature:  atob('l0VGm/wdBuDkrWaFJN35oG0pmiqbWHW20ymYeBlZmwdeEZ/8Ukfc'
            + '2MqTlw+zIDUSQgBYw2f97HLBjWU6gHsIAw=='),
        signedContent: atob('AgAAAQEDAAAM71BrlkBJXmR5xRtMBgAABEFJAAAHAAAG67lptSuY'),
        type: 0x01,
        nonce: atob('71BrlkBJXmR5xRtM'),
        recipients: [],
        keys: [],
        keyIds: [KEY_ID],
        includeParticipants: [],
        excludeParticipants: [],
        payload: atob('67lptSuY')
    };
    var ROTATED_KEY = atob('D/1apgnOpfzZqrYi95t5pw==');
    var ROTATED_KEY_ID = atob('QUkAAQ==');
    var ROTATION_MESSAGE_BIN = atob('AAEAAEB6MqjdQi8U2RiFyLdeX6hONPNJVugKL8Jjt'
        + 'NBEH1+elTgItQqv+/pE6gb8zqchv59I6tMhM5e+BI45/djWY7APAgAAAQADAAAM71Br'
        + 'lkBJXmR5xRtMBAAACMqLuOeu/PccBQAAIIHgbD1AGIFO6HIagNL3pjHAGnKW+WwMuh2'
        + 'eweVCfnY6BgAACEFJAAFBSQAABwAABh+/GnXzGA==');
    var ROTATION_MESSAGE = {
        protocolVersion: 0,
        signature:  atob('ejKo3UIvFNkYhci3Xl+oTjTzSVboCi/CY7TQRB9fnpU4CLUKr/v6R'
            + 'OoG/M6nIb+fSOrTITOXvgSOOf3Y1mOwDw=='),
        signedContent: atob('AgAAAQADAAAM71BrlkBJXmR5xRtMBAAACMqLuOeu/PccBQAAII'
            + 'HgbD1AGIFO6HIagNL3pjHAGnKW+WwMuh2eweVCfnY6BgAACEFJAAFBSQAABwAABh'
            + '+/GnXzGA=='),
        type: 0x00,
        nonce: atob('71BrlkBJXmR5xRtM'),
        recipients: ['you456789xw'],
        keys: [atob('geBsPUAYgU7ochqA0vemMcAacpb5bAy6HZ7B5UJ+djo=')],
        keyIds: [ROTATED_KEY_ID, KEY_ID],
        includeParticipants: [],
        excludeParticipants: [],
        payload: atob('H78adfMY')
    };
    var ROTATION_MESSAGE_BIN_PROTOCOL_1 = atob('AQEAAEB6MqjdQi8U2RiFyLdeX6hONPN'
        + 'JVugKL8JjtNBEH1+elTgItQqv+/pE6gb8zqchv59I6tMhM5e+BI45/djWY7APAgAAAQA'
        + 'DAAAM71BrlkBJXmR5xRtMBAAACMqLuOeu/PccBQAAIIHgbD1AGIFO6HIagNL3pjHAGnK'
        + 'W+WwMuh2eweVCfnY6BgAAEBzN3yhOpQABHM3fKE6lAAA=');
    var REMINDER_MESSAGE_BIN = atob('AQEAAEDct7zij9MwC0VFxLSQ+wWe+aG83Rv9NoP1V'
        + 'bGW/tFy9jmPxL9Y0UgvFeazKlCh9maWzjJ3rhHUj1BfQ5nq5MECAgAAAQADAAAM71Br'
        + 'lkBJXmR5xRtMBAAACMqLuOeu/PccBQAAEIHgbD1AGIFO6HIagNL3pjEGAAAEQUkAAQ==');
    var REMINDER_MESSAGE = {
        protocolVersion: 1,
        signature:  atob('3Le84o/TMAtFRcS0kPsFnvmhvN0b/TaD9VWxlv7RcvY5j8S/WNFIL'
            + 'xXmsypQofZmls4yd64R1I9QX0OZ6uTBAg=='),
        signedContent: atob('AgAAAQADAAAM71BrlkBJXmR5xRtMBAAACMqLuOeu/PccBQAAEI'
            + 'HgbD1AGIFO6HIagNL3pjEGAAAEQUkAAQ=='),
        type: 0x00,
        nonce: atob('71BrlkBJXmR5xRtM'),
        recipients: ['you456789xw'],
        keys: [atob('geBsPUAYgU7ochqA0vemMQ==')],
        keyIds: [ROTATED_KEY_ID],
        includeParticipants: [],
        excludeParticipants: []
    };
    var PARTICIPANT_CHANGE_MESSAGE_BIN = atob('AQEAAEBBh/ndnYVhfhamD/l1yph0/uf'
            + 'uZhDU/yn/sOP3l3sqrV3bb8QiJX38OeDJAEWoYZV0IcuP8EbDNXKT1mxJftEPAg'
            + 'AAAQIDAAAM71BrlkBJXmR5xRtMBAAACJYp6Oeu/PccBQAAENp0rdw/Yf2dfMwY6'
            + 'xCJi3QGAAAIQUkAAUFJAAAHAAAGH78adfMYCAAACJYp6Oeu/PccCQAACKLbaOeu'
            + '/Pcc');
    var PARTICIPANT_CHANGE_MESSAGE = {
        protocolVersion: 1,
        signature:  atob('QYf53Z2FYX4Wpg/5dcqYdP7n7mYQ1P8p/7Dj95d7Kq1d22/EIiV9'
            + '/DngyQBFqGGVdCHLj/BGwzVyk9ZsSX7RDw=='),
        signedContent: atob('AgAAAQIDAAAM71BrlkBJXmR5xRtMBAAACJYp6Oeu/PccBQAAE'
            + 'Np0rdw/Yf2dfMwY6xCJi3QGAAAIQUkAAUFJAAAHAAAGH78adfMY'),
        type: 0x02,
        nonce: atob('71BrlkBJXmR5xRtM'),
        recipients: ['lino56789xw'],
        keys: [atob('2nSt3D9h/Z18zBjrEImLdA==')],
        keyIds: [ROTATED_KEY_ID, KEY_ID],
        includeParticipants: ['lino56789xw'],
        excludeParticipants: ['otto56789xw'],
        payload: atob('H78adfMY')
    };
    var RSA_ENCRYPTED_KEYS = atob('BAAzD19I72pnZXXRJJXuFrm+90rXuhWiprGpUP/7oxr'
        + 'yvt6XW6F/ObfgC0Ni+Rc6UhQc6Autwj6IlQMN9QDeVp6r4oJ1jIOoDlGCzLYRP0wQyY'
        + 'uTVk+cSmsZMKlRocduzt1mNYAS8kozzHoHij8PcH9QG4tpaDCNX4FteQuyIP6hvA==');

    // For setting up participants and ensuring we have legit key ids
    var UNIQUE_DEVICE_ID = a32_to_str([483254056]);
    var DATESTAMP = 20133;
    var KEY_ID_0 = UNIQUE_DEVICE_ID + a32_to_str([1319436288]);
    var KEY_ID_1 = UNIQUE_DEVICE_ID + a32_to_str([1319436289]);
    var KEY_ID_2 = UNIQUE_DEVICE_ID + a32_to_str([1319436290]);
    var KEY_ID_MAXCOUNTER  = UNIQUE_DEVICE_ID + a32_to_str([1319501823]);
    var KEY_ID_MAXCOUNTER_YESTERDAY = UNIQUE_DEVICE_ID + a32_to_str([1319436287]);


    // Create/restore Sinon stub/spy/mock sandboxes.
    var sandbox = null;

    var _echo = function(x) { return x; };
    var _copy = function(source) {
        var __copy = function(dest) {
            for (var i = 0; i < source.length; i++) {
                dest[i] = source.charCodeAt(i);
            }
        };
        return __copy;
    };
    var _bytesOfString = function(x) {
        var result = [];
        for (var i = 0; i < x.length; i++) {
            result.push(x.charCodeAt(i));
        }
        return new Uint8Array(result);
    };

    beforeEach(function() {
        sandbox = sinon.sandbox.create();
    });

    afterEach(function() {
        sandbox.restore();
    });

    describe('en-/decryption', function() {
        describe('_symmetricEncryptMessage', function() {
            it("all parameters given", function() {
                sandbox.stub(window, 'to8', _echo);
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(asmCrypto.AES_CTR, 'encrypt').returns('cipher text');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);
                sandbox.stub(ns, 'deriveNonceSecret', _echo);

                var result = ns._symmetricEncryptMessage('forty two', 'the key', 'gooniegoogoo');
                assert.deepEqual(result,
                    { ciphertext: 'cipher text', key: 'the key', nonce: 'gooniegoogoo' });
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 3);
                assert.strictEqual(ns.deriveNonceSecret.callCount, 1);
                assert.strictEqual(to8.callCount, 1);
                assert.strictEqual(asmCrypto.AES_CTR.encrypt.callCount, 1);
                assert.deepEqual(asmCrypto.AES_CTR.encrypt.args[0],
                    ['forty two', 'the key', 'gooniegoogoo']);
                assert.strictEqual(asmCrypto.bytes_to_string.callCount, 2);
            });

            it("binary", function() {
                var result = ns._symmetricEncryptMessage('forty two', KEY, NONCE);
                assert.strictEqual(btoa(result.ciphertext), 'J+79wd1gGVjQ');
                assert.strictEqual(btoa(result.key), btoa(KEY));
                assert.strictEqual(btoa(result.nonce), btoa(NONCE));
            });

            it("missing nonce", function() {
                sandbox.stub(window, 'to8', _echo);
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(asmCrypto, 'getRandomValues', _copy('gooniegoogoo'));
                sandbox.stub(asmCrypto.AES_CTR, 'encrypt').returns('cipher text');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('gooniegoogoo');

                var result = ns._symmetricEncryptMessage('forty two', 'the key');
                assert.deepEqual(result, { ciphertext: 'cipher text', key: 'the key',
                                           nonce: _bytesOfString('gooniegoogoo') });
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 3);
                assert.strictEqual(ns.deriveNonceSecret.callCount, 1);
                assert.strictEqual(asmCrypto.getRandomValues.callCount, 1);
                assert.strictEqual(to8.callCount, 1);
                assert.strictEqual(asmCrypto.AES_CTR.encrypt.callCount, 1);
                assert.strictEqual(asmCrypto.bytes_to_string.callCount, 3);
            });

            it("message only", function() {
                sandbox.stub(window, 'to8', _echo);
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                var counter = 0;
                var _getRandomValues = function(x) {
                    counter++;
                    var value = (counter === 1) ? 'a new secret key' : 'gooniegoogoo';
                    return _copy(value)(x);
                };
                sandbox.stub(asmCrypto, 'getRandomValues', _getRandomValues);
                sandbox.stub(asmCrypto.AES_CTR, 'encrypt').returns('cipher text');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('gooniegoogoo');

                var result = ns._symmetricEncryptMessage('forty two');
                assert.deepEqual(result, { ciphertext: 'cipher text',
                                           key: _bytesOfString('a new secret key'),
                                           nonce: _bytesOfString('gooniegoogoo') });
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 2);
                assert.strictEqual(asmCrypto.getRandomValues.callCount, 2);
                assert.strictEqual(ns.deriveNonceSecret.callCount, 1);
                assert.strictEqual(to8.callCount, 1);
                assert.strictEqual(asmCrypto.AES_CTR.encrypt.callCount, 1);
                assert.strictEqual(asmCrypto.bytes_to_string.callCount, 3);
            });

            it("no message conten", function() {
                var counter = 0;
                var _getRandomValues = function(x) {
                    counter++;
                    var value = (counter % 2 === 1) ? KEY : NONCE;
                    return _copy(value)(x);
                };
                sandbox.stub(asmCrypto, 'getRandomValues', _getRandomValues);
                var tests = [null, undefined];
                var result;

                for (var i = 0; i < tests.length; i++) {
                    result = ns._symmetricEncryptMessage(tests[i]);
                    assert.deepEqual(result, { ciphertext: null,
                                               key: KEY,
                                               nonce: atob('MTHgl79y+1FFnmno') });
                    assert.strictEqual(asmCrypto.getRandomValues.callCount, 2 * (i + 1));
                }
            });
        });

        describe('_symmetricDecryptMessage', function() {
            it("all parameters given", function() {
                sandbox.stub(window, 'decodeURIComponent', _echo);
                sandbox.stub(window, 'escape', _echo);
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(asmCrypto.AES_CTR, 'decrypt').returns('forty two');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('gooniegoogoo');

                var result = ns._symmetricDecryptMessage('cipher text', 'the key', 'gooniegoogoo');
                assert.deepEqual(result, 'forty two');
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 3);
                assert.strictEqual(ns.deriveNonceSecret.callCount, 1);
                assert.strictEqual(asmCrypto.AES_CTR.decrypt.callCount, 1);
                assert.deepEqual(asmCrypto.AES_CTR.decrypt.args[0],
                    ['cipher text', 'the key', 'gooniegoogoo']);
                assert.strictEqual(asmCrypto.bytes_to_string.callCount, 1);
                assert.strictEqual(decodeURIComponent.callCount, 1);
                assert.strictEqual(escape.callCount, 1);
            });

            it("binary", function() {
                var result = ns._symmetricDecryptMessage(atob('J+79wd1gGVjQ'), KEY, NONCE);
                assert.strictEqual(result, 'forty two');
            });

            it("binary, empty message", function() {
                var result = ns._symmetricDecryptMessage('', KEY, NONCE);
                assert.strictEqual(result, '');
            });

            it("binary, null message", function() {
                var result = ns._symmetricDecryptMessage(null, KEY, NONCE);
                assert.strictEqual(result, null);
            });

            it("binary, undefined message", function() {
                var result = ns._symmetricDecryptMessage(undefined, KEY, NONCE);
                assert.strictEqual(result, null);
            });

            it("decryption fails", function() {
                sandbox.stub(ns._logger, '_log');
                var result = ns._symmetricDecryptMessage(atob('J+79wd1gGVjQ'), KEY,
                    atob('NTHgl79y+1FFnmnopp4UNA=='));
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Could not decrypt message, probably a wrong key/nonce.');
            });
        });

        describe('_symmetricEncryptMessage/_symmetricDecryptMessage', function() {
            it("round trips", function() {
                var tests = ['42', "Don't panic!", 'Flying Spaghetti Monster',
                             "Ph'nglui mglw'nafh Cthulhu R'lyeh wgah'nagl fhtagn",
                             'Tēnā koe', 'Hänsel & Gretel', 'Слартибартфаст'];
                var encrypted;
                var decrypted;
                var testValue;
                for (var i = 0; i < tests.length; i++) {
                    testValue = tests[i];
                    encrypted = strongvelope._symmetricEncryptMessage(testValue);
                    decrypted = strongvelope._symmetricDecryptMessage(
                        encrypted.ciphertext, encrypted.key, encrypted.nonce);
                    assert.strictEqual(testValue, decrypted);
                }
            });
        });

        describe('_signMessage', function() {
            it("vanilla case", function() {
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(nacl.sign, 'detached').returns('squiggle');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);

                var result = ns._signMessage('forty two', 'private key', 'public key');
                assert.strictEqual(result, 'squiggle');
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 2);
                assert.strictEqual(nacl.sign.detached.callCount, 1);
                assert.deepEqual(nacl.sign.detached.args[0],
                    ['strongvelopesigforty two', 'private keypublic key']);
                assert.strictEqual(asmCrypto.bytes_to_string.callCount, 1);
            });

            it("binary", function() {
                var result = ns._signMessage('forty two', ED25519_PRIV_KEY, ED25519_PUB_KEY);
                assert.strictEqual(btoa(result),
                    'WlGvF9zODTQOA+lTrb2jRe8bCz7Azhh2/9hze54SPWJpbfZ41SUZswe3b8KjpO0o3id9FVpNFI63ToXjw+iRCQ==');
            });
        });

        describe('_verifyMessage', function() {
            it("vanilla case", function() {
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(nacl.sign.detached, 'verify').returns(true);

                var result = ns._verifyMessage('forty two', 'squiggle', 'public key');
                assert.deepEqual(result, true);
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 3);
                assert.strictEqual(nacl.sign.detached.verify.callCount, 1);
                assert.deepEqual(nacl.sign.detached.verify.args[0],
                    ['strongvelopesigforty two', 'squiggle', 'public key']);
            });

            it("binary", function() {
                var signature = atob('WlGvF9zODTQOA+lTrb2jRe8bCz7Azhh2/9hze54S'
                    + 'PWJpbfZ41SUZswe3b8KjpO0o3id9FVpNFI63ToXjw+iRCQ==');
                var result = ns._verifyMessage('forty two', signature, ED25519_PUB_KEY);
                assert.deepEqual(result, true);
            });
        });

        describe('deriveSharedKey()', function() {
            var baseCase = "\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b" +
                           "\x0b\x0b\x0b\x0b\x0b\x0b";

            it("sanity check", function() {
                // Test Case 3 from RFC 5869.
                assert.strictEqual(btoa(ns.deriveSharedKey(baseCase, '')),
                    btoa('\x8d\xa4\xe7\x75\xa5\x63\xc1\x8f\x71\x5f\x80\x2a\x06\x3c\x5a\x31' +
                         '\xb8\xa1\x1f\x5c\x5e\xe1\x87\x9e\xc3\x45\x4e\x5f\x3c\x73\x8d\x2d'));
            });

            it("base case", function() {
                // Test against Python:
                // >>> from hmac import HMAC; from hashlib import sha256
                // >>> import base64
                // >>> hmac = lambda *args: HMAC(*args, digestmod=sha256)
                // >>> base64.b64encode(hmac(hmac(b'', b'\x0b'*22).digest(), b'mpenc group key\x01').digest())
                // 'c9cc6b03feceadd360859a46932477ca924cc646be0d6f07dc8c4e2d49bd6301'
                assert.strictEqual(btoa(ns.deriveSharedKey(baseCase, 'mpenc group key')),
                    'ycxrA/7OrdNghZpGkyR3ypJMxka+DW8H3IxOLUm9YwE=');
            });
        });

        describe('deriveNonceSecret()', function() {
            var baseCase = "\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b\x0b" +
                           "\x0b\x0b\x0b\x0b\x0b\x0b";

            it("base case", function() {
                // Test against Python:
                // >>> from hmac import HMAC; from hashlib import sha256
                // >>> import base64
                // >>> hmac = lambda *args: HMAC(*args, digestmod=sha256)
                // >>> base64.b64encode(hmac(b'\x0b' * 22, b'payload').digest())
                // 'g4i49V8v6SjBNlg5dBTfvoxbrFjvLLY9NIu0ax/IW0Y='
                assert.strictEqual(btoa(ns.deriveNonceSecret(baseCase)),
                    'g4i49V8v6SjBNlg5dBTfvoxbrFjvLLY9NIu0ax/IW0Y=');
            });

            it("empty master nonce", function() {
                // Test against Python:
                // >>> base64.b64encode(hmac(b'', b'payload').digest())
                // '+BqVrzgYecM/lkxYn6CW+hM6B2BumXblRwYOeg6g9fM='
                assert.strictEqual(btoa(ns.deriveNonceSecret('')),
                    '+BqVrzgYecM/lkxYn6CW+hM6B2BumXblRwYOeg6g9fM=');
            });
        });

        describe('_parseMessageContent', function() {
            it("keyed message", function() {
                var result = ns._parseMessageContent(INITIAL_MESSAGE_BIN);
                assert.deepEqual(result, INITIAL_MESSAGE);
            });

            it("followup message", function() {
                var result = ns._parseMessageContent(FOLLOWUP_MESSAGE_BIN);
                assert.deepEqual(result, FOLLOWUP_MESSAGE);
            });

            it("rotation message", function() {
                var result = ns._parseMessageContent(ROTATION_MESSAGE_BIN);
                assert.deepEqual(result, ROTATION_MESSAGE);
            });

            it("reminder message", function() {
                var result = ns._parseMessageContent(REMINDER_MESSAGE_BIN);
                assert.deepEqual(result, REMINDER_MESSAGE);
            });

            it("unexpected TLV type", function() {
                sandbox.stub(ns._logger, '_log');
                var message = INITIAL_MESSAGE_BIN.substring(0, 1)
                    + String.fromCharCode(0x42) +  INITIAL_MESSAGE_BIN.substring(2);
                var result = ns._parseMessageContent(message);
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Received unexpected TLV type: 66.');
            });
        });
    });

    describe('ProtocolHandler class', function() {
        var _toTlvRecord = function(_, content) {
            return '|' + content;
        };

        var _toTlvRecordWType = function(type, content) {
            return '|' + type + ':' + content;
        };

        describe('_parseAndExtractKeys', function() {
            it("all bases covered", function() {
                // This mock-history contains chatd as well as parsed data in one object.
                // The attribute `keys` just needs to be there to avoid an exception.
                var history = [
                    { userId: 'me3456789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['you456789xw'], keyIds: ['AI01'], keys: [], message: 'payload 0' },
                    { userId: 'me3456789xw', ts: 1444255634, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AI01'], message: 'payload 1' },
                    { userId: 'you456789xw', ts: 1444255635, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 2' },
                    { userId: 'me3456789xw', ts: 1444255636, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['you456789xw'], keyIds: ['AI02', 'AI01'], keys: [], message: 'payload 3' },
                    { userId: 'you456789xw', ts: 1444255637, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 4' },
                    { userId: 'you456789xw', ts: 1444255638, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 5' },
                    { userId: 'you456789xw', ts: 1444255639, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['me3456789xw'], keyIds: ['AIf2', 'AIf1'], keys: [], message: 'payload 6' },
                ];
                var compareKeys = [
                    { 'AI01': 'foo' },
                    {},
                    {},
                    { 'AI02': 'foo', 'AI01': 'bar' },
                    {},
                    {},
                    { 'AIf2': 'foo', 'AIf1': 'bar' },
                ];
                sandbox.stub(ns, '_verifyMessage').returns(true);
                var i;
                sandbox.stub(ns, '_parseMessageContent', function() {
                    return history[i];
                });
                var handler;
                var result;
                var message;

                // jshint loopfunc: true
                for (i = 0; i < history.length; i++) {
                    handler = new ns.ProtocolHandler('me3456789xw',
                        CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                    message = history[i];
                    sandbox.stub(handler, '_decryptKeysFor', function() {
                        return ['foo', 'bar'].slice(0, message.keyIds.length);
                    });
                    result = handler._parseAndExtractKeys(message);
                    assert.deepEqual(result.parsedMessage, message);
                    assert.deepEqual(result.senderKeys, compareKeys[i]);
                }
                // jshint loopfunc: false
            });

            it("bad signature", function() {
                var message = {
                    userId: 'me3456789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                    recipients: ['you456789xw'], keyIds: ['AI01'], keys: [], message: 'payload 0'
                };
                sandbox.stub(ns, '_verifyMessage').returns(false);
                sandbox.stub(ns, '_parseMessageContent').returns(message);
                var handler = new ns.ProtocolHandler('me3456789xw',
                        CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                var result = handler._parseAndExtractKeys(message);
                assert.strictEqual(result, false);
            });

            it("on user who's been excluded", function() {
                var message = {
                    userId: 'papa56789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.ALTER_PARTICIPANTS,
                    recipients: ['lino56789xw'], keyIds: ['AI01'], keys: [], message: 'payload 0'
                };
                sandbox.stub(ns, '_verifyMessage').returns(true);
                sandbox.stub(ns, '_parseMessageContent').returns(message);
                var handler = new ns.ProtocolHandler('otto56789xw',
                        CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                var result = handler._parseAndExtractKeys(message);
                assert.deepEqual(result.parsedMessage, message);
                assert.deepEqual(result.senderKeys, {});
            });
        });

        describe('_batchParseAndExtractKeys', function() {
            it("all bases covered", function() {
                // This mock-history contains chatd as well as parsed data in one object.
                // The attribute `keys` just needs to be there to avoid an exception.
                var history = [
                    { userId: 'me3456789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['you456789xw'],
                      keyIds: ['AI01'], keys: ['foo1'], message: 'payload 0' },
                    { userId: 'me3456789xw', ts: 1444255634, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AI01'], message: 'payload 1' },
                    { userId: 'you456789xw', ts: 1444255635, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 2' },
                    { userId: 'me3456789xw', ts: 1444255636, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['you456789xw'],
                      keyIds: ['AI02', 'AI01'], keys: ['foo2', 'foo1'], message: 'payload 3' },
                    { userId: 'you456789xw', ts: 1444255637, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 4' },
                    { userId: 'you456789xw', ts: 1444255638, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 5' },
                    { userId: 'you456789xw', ts: 1444255639, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['me3456789xw'],
                      keyIds: ['AIf2', 'AIf1'], keys: ['bar2', 'bar1'], message: 'payload 6' },
                ];
                var history_result = [
                    { userId: 'you456789xw', ts: 1444255639, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['me3456789xw'],
                      keyIds: ['AIf2', 'AIf1'], keys: ['bar2', 'bar1'], message: 'payload 6' },
                    { userId: 'you456789xw', ts: 1444255638, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 5' },
                    { userId: 'you456789xw', ts: 1444255637, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 4' },
                    { userId: 'me3456789xw', ts: 1444255636, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['you456789xw'],
                      keyIds: ['AI02', 'AI01'], keys: ['foo2', 'foo1'], message: 'payload 3' },
                    { userId: 'you456789xw', ts: 1444255635, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AIf1'], message: 'payload 2' },
                    { userId: 'me3456789xw', ts: 1444255634, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      keyIds: ['AI01'], message: 'payload 1' },
                    { userId: 'me3456789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      recipients: ['you456789xw'],
                      keyIds: ['AI01'], keys: ['foo1'], message: 'payload 0' },
                ];
                sandbox.stub(ns, '_verifyMessage').returns(true);
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_parseAndExtractKeys', function(value) {
                    var senderKeys = {};
                    if (value.keys) {
                        for (var i = 0; i < value.keys.length; i++) {
                            senderKeys[value.keyIds[i]] = value.keys[i];
                            if (!handler.participantKeys[value.userId]) {
                                handler.participantKeys[value.userId] = {};
                            }
                            handler.participantKeys[value.userId][value.keyIds[i]] = value.keys[i];
                        }
                    }
                    return { parsedMessage: value,
                             senderKeys: senderKeys };
                });
                var result = handler._batchParseAndExtractKeys(history);

                assert.deepEqual(result, history_result);
                assert.ok(handler.participantKeys['me3456789xw'].hasOwnProperty('AI01'));
                assert.ok(handler.participantKeys['me3456789xw'].hasOwnProperty('AI02'));
                assert.ok(handler.participantKeys['you456789xw'].hasOwnProperty('AIf1'));
                assert.ok(handler.participantKeys['you456789xw'].hasOwnProperty('AIf2'));
            });
        });

        describe('seed', function() {
            it("all bases covered", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);

                var participantKeys = {
                    'you456789xw': { 'AIf1': 'your key 1', 'AIf2': 'your key 2' }
                };
                participantKeys['me3456789xw'] = {};
                participantKeys['me3456789xw'][KEY_ID_1] = 'my key 1';
                participantKeys['me3456789xw'][KEY_ID_2] = 'my key 2';

                sandbox.stub(handler, '_batchParseAndExtractKeys', function() {
                    handler.participantKeys = participantKeys;
                });

                var result = handler.seed(['dummy']);
                assert.strictEqual(result, true);
                assert.strictEqual(handler.keyId, KEY_ID_2);
                assert.strictEqual(handler.previousKeyId, KEY_ID_1);
                assert.deepEqual(handler.participantKeys, participantKeys);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 0);
                assert.strictEqual(handler._sentKeyId, null);
            });

            it("missing keys other party", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);

                var participantKeys = {};
                participantKeys['me3456789xw'] = {};
                participantKeys['me3456789xw'][KEY_ID_1] = 'my key 1';
                participantKeys['me3456789xw'][KEY_ID_2] = 'my key 2';

                sandbox.stub(handler, '_batchParseAndExtractKeys', function() {
                    handler.participantKeys = participantKeys;
                });

                var result = handler.seed(['dummy']);
                assert.strictEqual(result, true);
                assert.strictEqual(handler.keyId, KEY_ID_2);
                assert.strictEqual(handler.previousKeyId, KEY_ID_1);
                assert.deepEqual(handler.participantKeys, participantKeys);
            });

            it("no own keys", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                var participantKeys = {
                    'you456789xw': { 'AIf1': 'your key 1', 'AIf2': 'your key 2' }
                };
                sandbox.stub(handler, '_batchParseAndExtractKeys', function() {
                    handler.participantKeys = participantKeys;
                });

                var result = handler.seed(['dummy']);
                assert.strictEqual(result, false);
                assert.strictEqual(handler.keyId, null);
                assert.strictEqual(handler.previousKeyId, null);
                assert.deepEqual(handler.participantKeys, participantKeys);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 0);
                assert.strictEqual(handler._sentKeyId, null);
            });
        });

        describe('updateSenderKey', function() {
            it("initial usage", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'your key' });
                sandbox.stub(ns, '_dateStampNow').returns(DATESTAMP);
                sandbox.stub(asmCrypto, 'getRandomValues', _copy(KEY));
                handler.updateSenderKey();
                var obj = {};
                obj[KEY_ID_0] = KEY;
                // console.log(btoa(handler.keyId));
                assert.strictEqual(handler.keyId, KEY_ID_0);
                assert.strictEqual(handler.previousKeyId, null);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    obj);
                assert.strictEqual(handler._keyEncryptionCount, 0);
            });

            it("key rotation", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID_0;
                handler._sentKeyId = handler.keyId;
                var obj = {};
                obj[KEY_ID_0] = KEY;

                var rotobj = {};
                rotobj[KEY_ID_0] = KEY;
                rotobj[KEY_ID_1] = ROTATED_KEY;

                handler.participantKeys = { 'me3456789xw': obj };
                handler._keyEncryptionCount = 16;
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'your key' });
                sandbox.stub(ns, '_dateStampNow').returns(DATESTAMP);
                sandbox.stub(asmCrypto, 'getRandomValues', _copy(ROTATED_KEY));
                handler.updateSenderKey();
                assert.strictEqual(handler.keyId, KEY_ID_1);
                assert.strictEqual(handler.previousKeyId, KEY_ID_0);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    rotobj);
                assert.strictEqual(handler._keyEncryptionCount, 0);
            });

            it("key rotation, per day overflow", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID_MAXCOUNTER;
                handler._sentKeyId = handler.keyId;

                var obj = {};
                obj[KEY_ID_MAXCOUNTER] = KEY;

                handler.participantKeys = { 'me3456789xw': obj };
                handler._keyEncryptionCount = 16;
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'your key' });
                sandbox.stub(ns, '_dateStampNow').returns(DATESTAMP);
                assert.throws(function() { handler.updateSenderKey(); },
                    'This should hardly happen, but 2^16 keys were used for the day. Bailing out!');
            });

            it("key rotation with new day", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID_MAXCOUNTER_YESTERDAY;
                handler._sentKeyId = KEY_ID_MAXCOUNTER_YESTERDAY;

                var obj = {};
                obj[KEY_ID_MAXCOUNTER_YESTERDAY] = KEY;

                var rotobj = {};
                rotobj[KEY_ID_MAXCOUNTER_YESTERDAY] = KEY;
                rotobj[KEY_ID_0] = ROTATED_KEY;

                handler.participantKeys = { 'me3456789xw': obj };
                handler._keyEncryptionCount = 16;
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'your key' });
                sandbox.stub(ns, '_dateStampNow').returns(DATESTAMP);
                sandbox.stub(asmCrypto, 'getRandomValues', _copy(ROTATED_KEY));
                handler.updateSenderKey();
                assert.strictEqual(handler.keyId, KEY_ID_0);
                assert.strictEqual(handler.previousKeyId, KEY_ID_MAXCOUNTER_YESTERDAY);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    rotobj);
                assert.strictEqual(handler._keyEncryptionCount, 0);
            });

            it("avoid multiple, successive rotations", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID;
                handler._sentKeyId = handler.keyId;
                handler.participantKeys = { 'me3456789xw': { 'AI\u0000\u0000': KEY} };
                sandbox.stub(ns, '_dateStampNow').returns(16713);
                handler.updateSenderKey();
                var rotatedKeyId = handler.keyId;
                var rotatedKey = handler.participantKeys['me3456789xw'][rotatedKeyId];
                assert.notStrictEqual(handler.keyId, KEY_ID);
                assert.notStrictEqual(rotatedKey, KEY);
                assert.strictEqual(handler.previousKeyId, KEY_ID);

                // Now do it again.
                handler.updateSenderKey();
                assert.strictEqual(handler.keyId, rotatedKeyId);
                assert.strictEqual(handler.participantKeys['me3456789xw'][rotatedKeyId], rotatedKey);
                assert.strictEqual(handler.previousKeyId, KEY_ID);
            });
        });

        describe('_computeSymmetricKey', function() {
            it("normal operation", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'your key' });
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(nacl, 'scalarMult').returns('shared secret');
                sandbox.stub(ns, 'deriveSharedKey', _echo);

                var result = handler._computeSymmetricKey('you456789xw');
                assert.strictEqual(result, 'shared secret');
                assert.strictEqual(asmCrypto.string_to_bytes.callCount, 2);
                assert.strictEqual(nacl.scalarMult.callCount, 1);
                assert.strictEqual(ns.deriveSharedKey.callCount, 1);
            });

            it("binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                var result = handler._computeSymmetricKey('you456789xw');
                assert.strictEqual(btoa(result),
                    'vb4//1yAvz0AHQnUUrrL0mcNr4xN9rRu7+6YMFQQf6U=');
            });

            it("missing recipient pubkey", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(ns._logger, '_log');
                sandbox.stub(window, 'pubCu25519', {});
                assert.throws(function() { handler._computeSymmetricKey('you456789xw'); },
                              'No cached chat key for user!');
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'No cached chat key for user!');
                assert.strictEqual(ns._logger._log.args[1][0],
                                   'No cached chat key for user: you456789xw');
            });
        });

        describe('_encryptKeysFor', function() {
            it("single key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'dummy' });
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('IV');
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    { substring: sinon.stub().returns('the key') });
                sandbox.stub(asmCrypto.AES_CBC, 'encrypt').returns('ciphertext');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);

                var result = handler._encryptKeysFor(['a key'], 'gooniegoogoo', 'you456789xw');
                assert.strictEqual(result, 'ciphertext');
                assert.strictEqual(asmCrypto.AES_CBC.encrypt.callCount, 1);
                assert.deepEqual(asmCrypto.AES_CBC.encrypt.args[0],
                    ['a key', 'the key', false, 'IV']);
            });

            it("two keys", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': 'dummy' });
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('IV');
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    { substring: sinon.stub().returns('the key') });
                sandbox.stub(asmCrypto.AES_CBC, 'encrypt').returns('ciphertext');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);

                var result = handler._encryptKeysFor(['key one', 'key two'], 'gooniegoogoo', 'you456789xw');
                assert.strictEqual(result, 'ciphertext');
                assert.strictEqual(asmCrypto.AES_CBC.encrypt.callCount, 1);
                assert.deepEqual(asmCrypto.AES_CBC.encrypt.args[0],
                    ['key onekey two', 'the key', false, 'IV']);
            });

            it("binary, one key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._encryptKeysFor([KEY], NONCE, 'you456789xw');
                assert.strictEqual(btoa(result), 'OvYk3sSnXIRPOZLV6C71pw==');
            });

            it("binary, two keys", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._encryptKeysFor([ROTATED_KEY, KEY], NONCE, 'you456789xw');
                assert.strictEqual(btoa(result), 'jQSMirQJ2JMwR15lsUf1gXvJWaOX1/CtIYTgNocf7Y8=');
            });

            it("binary, two keys, to self", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'me3456789xw': CU25519_PUB_KEY });
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._encryptKeysFor([ROTATED_KEY, KEY], NONCE, 'me3456789xw');
                assert.strictEqual(btoa(result), '8ObnafP2TzOoPkM1E1qh4mFxKp22uPA9d7CUS/GMj5Q=');
            });

            it("single key, no chat key", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'u_pubkeys', { 'you456789xw': 'dummy' });
                sandbox.stub(crypt, 'rsaEncryptString').returns('ciphertext');

                var result = handler._encryptKeysFor(['a key'], 'gooniegoogoo', 'you456789xw');
                assert.strictEqual(result, 'ciphertext');
                assert.strictEqual(ns._logger._log.args[0][0],
                    'Encrypting sender keys for you456789xw using RSA.');
            });

            it("binary, two keys, no chat key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'u_pubkeys', { 'you456789xw': RSA_PUB_KEY });
                sandbox.stub(crypt, 'rsaEncryptString').returns(RSA_ENCRYPTED_KEYS);

                var result = handler._encryptKeysFor([ROTATED_KEY, KEY], NONCE, 'you456789xw');
                assert.strictEqual(btoa(result), btoa(RSA_ENCRYPTED_KEYS));
            });

            it("single key, no destination key whatsoever", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(crypt, 'rsaEncryptString').returns('ciphertext');

                var result = handler._encryptKeysFor(['a key'], 'gooniegoogoo', 'you456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                    'No public encryption key (RSA or x25519) available for you456789xw');
            });
        });

        describe('_decryptKeysFor', function() {
            it("single key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('IV');
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    { substring: sinon.stub().returns('the key') });
                sandbox.stub(asmCrypto.AES_CBC, 'decrypt').returns('a key67890123456');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);

                var result = handler._decryptKeysFor('an encrypted key', 'gooniegoogoo', 'you456789xw');
                assert.deepEqual(result, ['a key67890123456']);
                assert.strictEqual(asmCrypto.AES_CBC.decrypt.callCount, 1);
                assert.deepEqual(asmCrypto.AES_CBC.decrypt.args[0],
                    ['an encrypted key', 'the key', false, 'IV']);
            });

            it("two keys", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(asmCrypto, 'string_to_bytes', _echo);
                sandbox.stub(ns, 'deriveNonceSecret').returns('IV');
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    { substring: sinon.stub().returns('the key') });
                sandbox.stub(asmCrypto.AES_CBC, 'decrypt').returns('a key67890123456another key23456');
                sandbox.stub(asmCrypto, 'bytes_to_string', _echo);

                var result = handler._decryptKeysFor('two encrypted keys', 'gooniegoogoo', 'you456789xw');
                assert.deepEqual(result, ['a key67890123456', 'another key23456']);
                assert.strictEqual(asmCrypto.AES_CBC.decrypt.callCount, 1);
                assert.deepEqual(asmCrypto.AES_CBC.decrypt.args[0],
                    ['two encrypted keys', 'the key', false, 'IV']);
            });

            it("binary, one key", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._decryptKeysFor(atob('OvYk3sSnXIRPOZLV6C71pw=='),
                                                     NONCE, 'me3456789xw');
                assert.deepEqual(result, [KEY]);
                assert.strictEqual(handler._computeSymmetricKey.args[0][0], 'me3456789xw');
            });

            it("binary, one key, sent myself", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._decryptKeysFor(atob('OvYk3sSnXIRPOZLV6C71pw=='),
                                                     NONCE, 'you456789xw', true);
                assert.deepEqual(result, [KEY]);
                assert.strictEqual(handler._computeSymmetricKey.args[0][0], 'you456789xw');
            });

            it("binary, two kes", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._decryptKeysFor(
                    atob('jQSMirQJ2JMwR15lsUf1gXvJWaOX1/CtIYTgNocf7Y8='), NONCE, 'me3456789xw');
                assert.deepEqual(result, [ROTATED_KEY, KEY]);
                assert.strictEqual(handler._computeSymmetricKey.args[0][0], 'me3456789xw');
            });

            it("binary, two kes, own key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_computeSymmetricKey').returns(
                    atob('X2O2IQoAqzPvr2F4XWjCuwP17tYHoJwB5KhyhlHb/mM='));

                var result = handler._decryptKeysFor(
                    atob('8ObnafP2TzOoPkM1E1qh4mFxKp22uPA9d7CUS/GMj5Q='), NONCE, 'me3456789xw');
                assert.deepEqual(result, [ROTATED_KEY, KEY]);
                assert.strictEqual(handler._computeSymmetricKey.args[0][0], 'me3456789xw');
            });

            it("single key, no chat key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(crypt, 'rsaDecryptString').returns('a key67890123456');

                var result = handler._decryptKeysFor(RSA_ENCRYPTED_KEYS, 'gooniegoogoo', 'you456789xw');
                assert.deepEqual(result, ['a key67890123456']);
            });

            it("binary, two kes, RSA encrypted", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'u_privk', RSA_PRIV_KEY);
                sandbox.stub(crypt, 'rsaDecryptString').returns(ROTATED_KEY + KEY);

                var result = handler._decryptKeysFor(RSA_ENCRYPTED_KEYS, NONCE, 'me3456789xw');
                assert.deepEqual(result, [ROTATED_KEY, KEY]);
            });
        });

        describe('_encryptSenderKey', function() {
            it("single recipient, no previous key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'k042';
                handler.participantKeys['me3456789xw']['k042'] = 'key_42';
                handler.otherParticipants = new Set(['you456789xw']);
                sandbox.stub(window, 'base64urldecode', function(dest) {
                    return dest + ',';
                });
                sandbox.stub(handler, '_encryptKeysFor', function(keys, _, to) {
                    return keys + ':' + to + ',';
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._encryptSenderKey('gooniegoogoo');
                assert.deepEqual(result, {
                    recipients: '|you456789xw,', keys: '|key_42:you456789xw,', keyIds: '|k042'
                });
            });

            it("single recipient, no previous key, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                var ENCRYPTED_SENDER_KEY = atob('q+J3tvgw2uJ3dFSZcQPWlQ==');
                handler.keyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler.otherParticipants = new Set(['you456789xw']);
                sandbox.stub(handler, '_encryptKeysFor').returns(ENCRYPTED_SENDER_KEY);

                var result = handler._encryptSenderKey(NONCE);
                assert.deepEqual(result, {
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw'),
                    keys: '\u0005\u0000\u0000\u0010' + ENCRYPTED_SENDER_KEY,
                    keyIds: '\u0006\u0000\u0000\u0004' + KEY_ID
                });
            });

            it("two recipients, no previous key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'k042';
                handler.participantKeys['me3456789xw']['k042'] = 'key_42';
                handler.otherParticipants = new Set(['you456789xw', 'other6789xw']);
                sandbox.stub(window, 'base64urldecode', function(dest) {
                    return dest;
                });
                sandbox.stub(handler, '_encryptKeysFor', function(keys, _, to) {
                    return keys + ':' + to;
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._encryptSenderKey('gooniegoogoo');
                assert.deepEqual(result, {
                    recipients: '|you456789xw|other6789xw',
                    keys: '|key_42:you456789xw|key_42:other6789xw',
                    keyIds: '|k042'
                });
            });

            it("two recipients, previous key", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'k042';
                handler.previousKeyId = 'k041';
                handler.participantKeys['me3456789xw']['k042'] = 'key_42';
                handler.participantKeys['me3456789xw']['k041'] = 'key_41';
                handler.otherParticipants = new Set(['you456789xw', 'other6789xw']);
                sandbox.stub(window, 'base64urldecode', function(dest) {
                    return dest;
                });
                sandbox.stub(handler, '_encryptKeysFor', function(keys, _, to) {
                    return keys + ':' + to;
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._encryptSenderKey('gooniegoogoo');
                assert.deepEqual(result, {
                    recipients: '|you456789xw|other6789xw',
                    keys: '|key_42,key_41:you456789xw|key_42,key_41:other6789xw',
                    keyIds: '|k042k041'
                });
            });

            it("three participants, one included, one excluded", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'k042';
                handler.previousKeyId = 'k041';
                handler.participantKeys['me3456789xw']['k042'] = 'key_42';
                handler.participantKeys['me3456789xw']['k041'] = 'key_41';
                handler.otherParticipants = new Set(['you456789xw', 'otto56789xw']);
                handler.includeParticipants = new Set(['lino56789xw']);
                handler.excludeParticipants = new Set(['otto56789xw']);
                sandbox.stub(window, 'base64urldecode', function(dest) {
                    return dest;
                });
                sandbox.stub(handler, '_encryptKeysFor', function(keys, _, to) {
                    return keys + ':' + to;
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._encryptSenderKey('gooniegoogoo');
                assert.deepEqual(result, {
                    recipients: '|you456789xw|lino56789xw',
                    keys: '|key_42,key_41:you456789xw|key_42:lino56789xw',
                    keyIds: '|k042k041'
                });
                assert.deepEqual(handler.otherParticipants, new Set(['you456789xw', 'lino56789xw']));
                assert.deepEqual(handler.includeParticipants, new Set());
                assert.deepEqual(handler.excludeParticipants, new Set());
            });

            it("two recipients, previous key, RSA for one", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'k042';
                handler.previousKeyId = 'k041';
                handler.participantKeys['me3456789xw']['k042'] = 'key_42';
                handler.participantKeys['me3456789xw']['k041'] = 'key_41';
                handler.otherParticipants = new Set(['you456789xw', 'other6789xw']);
                sandbox.stub(window, 'base64urldecode', function(dest) {
                    return dest;
                });
                // Just to make something long (> 128 chars) to trigger treating it as RSA.
                var _LONG_RSA = 'RSARSARSARSARSARSARSARSARSARSARSARSARSARSARSA'
                    + 'RSARSARSARSARSARSARSARSARSARSARSARSARSARSARSARSARSARSARSARSA';
                sandbox.stub(handler, '_encryptKeysFor', function(keys, _, to) {
                    var result = keys + ':' + to;
                    if (to === 'other6789xw') {
                        return _LONG_RSA + result;
                    }
                    return result;
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._encryptSenderKey('gooniegoogoo');
                assert.deepEqual(result, {
                    recipients: '|you456789xw|other6789xw',
                    keys: '|key_42,key_41:you456789xw|' + _LONG_RSA + 'key_42,key_41:other6789xw',
                    keyIds: '|k042k041',
                    ownKey: '|key_42,key_41:me3456789xw'
                });
            });

            it("two recipient, previous key, RSA for one, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                var ENCRYPTED_SENDER_KEY = atob('q+J3tvgw2uJ3dFSZcQPWlQ==');
                handler.keyId = ROTATED_KEY_ID;
                handler.previousKeyId = KEY_ID;
                handler.participantKeys['me3456789xw'][ROTATED_KEY_ID] = ROTATED_KEY;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler.otherParticipants = new Set(['you456789xw', 'other6789xw']);
                var _ENCRYPTED_KEYS = atob('jQSMirQJ2JMwR15lsUf1gXvJWaOX1/CtIYTgNocf7Y8=');
                sandbox.stub(handler, '_encryptKeysFor', function(keys, _, to) {
                    var result = keys + ':' + to;
                    if (to === 'other6789xw') {
                        return RSA_ENCRYPTED_KEYS;
                    }
                    return _ENCRYPTED_KEYS;
                });

                var result = handler._encryptSenderKey(NONCE);
                assert.deepEqual(result, {
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw')
                        + '\u0004\u0000\u0000\u0008' + base64urldecode('other6789xw'),
                    keys: '\u0005\u0000\u0000\u0020' + _ENCRYPTED_KEYS
                        + '\u0005\u0000\u0000\u0082' + RSA_ENCRYPTED_KEYS,
                    keyIds: '\u0006\u0000\u0000\u0008' + ROTATED_KEY_ID + KEY_ID,
                    ownKey: '\u000a\u0000\u0000\u0020' + _ENCRYPTED_KEYS
                });
            });

            it("no chat or RSA available", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = ROTATED_KEY_ID;
                handler.participantKeys['me3456789xw'][ROTATED_KEY_ID] = ROTATED_KEY;
                handler.otherParticipants = new Set(['you456789xw']);
                sandbox.stub(handler, '_encryptKeysFor').returns(false);

                var result = handler._encryptSenderKey(NONCE);
                assert.strictEqual(result, false);
            });
        });

        describe('_assembleBody', function() {
            it("keyed message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '|you456789xw',
                    keys: '|encrypted key',
                    keyIds: '|key ID'
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);
                assert.strictEqual(handler._sentKeyId, null);

                var result = handler._assembleBody('Hello!');
                assert.deepEqual(result,
                    { keyed: true, content:
                     '|gooniegoogoo|you456789xw|encrypted key|key ID' }
                 );
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 1);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 0);
                result = handler._assembleBody('World!');

                assert.deepEqual(result,
                    { keyed: false, content:
                     '|gooniegoogoo|key ID|ciphertext' }
                 );
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1+1);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1+0);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 1+3);
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });

            it("keyed, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('67lptSuY') });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw'),
                    keys: '\u0005\u0000\u0000\u0010' + atob('yJrGOPeYvAg4iTeYqW7New=='),
                    keyIds: '\u0006\u0000\u0000\u0004' + KEY_ID
                });

                var result = handler._assembleBody('Hello!');
                assert.strictEqual(result.keyed, true);
                assert.strictEqual(btoa(result.content), btoa(INITIAL_KEY_MESSAGE_BODY_BIN));
                assert.strictEqual(result.content.length, 56);
                assert.strictEqual(handler._keyEncryptionCount, 0);
            });

            it("keyed, key rotation, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = ROTATED_KEY_ID;
                handler.previousKeyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler.participantKeys['me3456789xw'][ROTATED_KEY_ID] = ROTATED_KEY;
                handler._sentKeyId = KEY_ID;
                handler._keyEncryptionCount = 0;
                handler._totalMessagesWithoutSendKey = 5;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: ROTATED_KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('67lptSuY') });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw'),
                    keys: '\u0005\u0000\u0000\u0020' + atob('geBsPUAYgU7ochqA0vemMcAacpb5bAy6HZ7B5UJ+djo='),
                    keyIds: '\u0006\u0000\u0000\u0008' + ROTATED_KEY_ID + KEY_ID
                });

                var result = handler._assembleBody('Hello!');
                assert.strictEqual(result.keyed, true);
                assert.strictEqual(result.content.length, 76);
                assert.strictEqual(handler.keyId, ROTATED_KEY_ID);
                assert.strictEqual(handler._sentKeyId, ROTATED_KEY_ID);
                assert.strictEqual(handler._keyEncryptionCount, 0);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 0);
            });

            it("keyed, key reminder on reaching total message count, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = ROTATED_KEY_ID;
                handler.previousKeyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler.participantKeys['me3456789xw'][ROTATED_KEY_ID] = ROTATED_KEY;
                handler._sentKeyId = ROTATED_KEY_ID;
                handler._keyEncryptionCount = 5;
                handler._totalMessagesWithoutSendKey = 30;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: ROTATED_KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('67lptSuY') });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw'),
                    keys: '\u0005\u0000\u0000\u0010' + atob('geBsPUAYgU7ochqA0vemMQ=='),
                    keyIds: '\u0006\u0000\u0000\u0004' + KEY_ID
                });

                var result = handler._assembleBody('Hello!');
                assert.strictEqual(result.keyed, true);
                assert.strictEqual(result.content.length, 56);
                assert.strictEqual(handler.keyId, ROTATED_KEY_ID);
                assert.strictEqual(handler._keyEncryptionCount, 5);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 0);
            });

            it("keyed, key reminder on reaching total message count, no content, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = ROTATED_KEY_ID;
                handler.previousKeyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler.participantKeys['me3456789xw'][ROTATED_KEY_ID] = ROTATED_KEY;
                handler._sentKeyId = ROTATED_KEY_ID;
                handler._keyEncryptionCount = 5;
                handler._totalMessagesWithoutSendKey = 30;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: ROTATED_KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: null });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw'),
                    keys: '\u0005\u0000\u0000\u0010' + atob('geBsPUAYgU7ochqA0vemMQ=='),
                    keyIds: '\u0006\u0000\u0000\u0004' + KEY_ID
                });

                var result = handler._assembleBody(null);
                assert.strictEqual(result.keyed, true);
                assert.strictEqual(result.content.length, 56);
                assert.strictEqual(handler.keyId, ROTATED_KEY_ID);
                assert.strictEqual(handler._keyEncryptionCount, 5);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 0);
            });

            it("followup message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                handler._sentKeyId = 'key ID';
                handler._keyEncryptionCount = 1;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._assembleBody('Hello!');
                assert.deepEqual(result,
                    { keyed: false, content: '|gooniegoogoo|key ID|ciphertext' });
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 3);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 2);
            });

            it("followup, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler._sentKeyId = KEY_ID;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('67lptSuY') });

                var result = handler._assembleBody('Hello!');
                assert.strictEqual(result.keyed, false);
                assert.strictEqual(btoa(result.content), btoa(FOLLOWUP_MESSAGE_BODY_BIN));
                assert.strictEqual(result.content.length, 34);
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });

            it("three participants, one included, one excluded", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler._sentKeyId = 'other key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                handler.otherParticipants = new Set(['you456789xw', 'otto56789xw']);
                handler.includeParticipants = new Set(['lino56789xw']);
                handler.excludeParticipants = new Set(['otto56789xw']);
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '|you456789xw|lino56789xw',
                    keys: '|key_42,key_41:you456789xw|key_42:lino56789xw',
                    keyIds: '|k042k041'
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);

                var result = handler._assembleBody('Hello!');
                assert.deepEqual(result,
                    { keyed: true, content:
                     '|gooniegoogoo|you456789xw|lino56789xw'
                     + '|key_42,key_41:you456789xw|key_42:lino56789xw'
                     + '|k042k041' }
                );
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 1);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 0);
            });

            it("keyed message, using RSA", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '|you456789xw',
                    keys: '|encrypted key',
                    keyIds: '|key ID',
                    ownKey: '|encrypted keys to self'
                });
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);
                assert.strictEqual(handler._sentKeyId, null);

                var result = handler._assembleBody('Hello!');

                assert.deepEqual(result, {
                    keyed: true,
                    content: '|gooniegoogoo|you456789xw|encrypted key|key ID'
                           + '|encrypted keys to self'
                });
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 1);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 0);
            });
        });

        describe('encryptTo', function() {
            it("to first member", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '|you456789xw',
                    keys: '|encrypted key',
                    keyIds: '|key ID'
                });
                sandbox.stub(ns, '_signMessage').returns('squiggle');
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);
                assert.strictEqual(handler._sentKeyId, null);

                var result = handler.encryptTo('Hello!', 'you456789xw');
                var expectedResult0 =  
                    PROTOCOL_VERSION_STRING + '|squiggle|\u0000|gooniegoogoo|you456789xw|encrypted key|key ID';
                var expectedResult1 = 
                    PROTOCOL_VERSION_STRING + '|squiggle|\u0001|gooniegoogoo|key ID|ciphertext';
                assert.strictEqual(result[0], expectedResult0);
                assert.strictEqual(result[1], expectedResult1);
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1*2);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 4*2);
                assert.strictEqual(ns._signMessage.callCount, 1*2);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.deepEqual(handler.otherParticipants, new Set(['you456789xw']));
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });

            it("destination not a member", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.otherParticipants = new Set(['other6789xw']);

                var result = handler.encryptTo('Hello!', 'you456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                    'Destination not in current participants: you456789xw');
            });

            it("no destination or participants", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';

                var result = handler.encryptTo('Hello!');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                    'No destinations or other participants to send to.');
            });

            it("keyed message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', 'private Ed');
                sandbox.stub(window, 'u_pubEd25519', 'public Ed');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '|you456789xw',
                    keys: '|encrypted key',
                    keyIds: '|key ID'
                });
                sandbox.stub(ns, '_signMessage').returns('squiggle');
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);
                assert.strictEqual(handler._sentKeyId, null);

                var result = handler.encryptTo('Hello!', 'you456789xw');
                var expectedResult0 = 
                    PROTOCOL_VERSION_STRING + '|squiggle|\u0000|gooniegoogoo|you456789xw|encrypted key|key ID';
                var expectedResult1 = 
                    PROTOCOL_VERSION_STRING + '|squiggle|\u0001|gooniegoogoo|key ID|ciphertext';
                assert.strictEqual(result[0], expectedResult0);
                assert.strictEqual(result[1], expectedResult1);
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1*2);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 4*2);
                assert.strictEqual(ns._signMessage.callCount, 1*2);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });

            it("keyed message, no explicit recipient", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                handler.otherParticipants = new Set(['you456789xw']);
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', 'private Ed');
                sandbox.stub(window, 'u_pubEd25519', 'public Ed');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '|you456789xw',
                    keys: '|encrypted key',
                    keyIds: '|key ID'
                });
                sandbox.stub(ns, '_signMessage').returns('squiggle');
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecord);
                assert.strictEqual(handler._sentKeyId, null);

                var result = handler.encryptTo('Hello!');
                var expectedResult0 = 
                    PROTOCOL_VERSION_STRING + '|squiggle|\u0000|gooniegoogoo|you456789xw|encrypted key|key ID';
                var expectedResult1 = 
                    PROTOCOL_VERSION_STRING + '|squiggle|\u0001|gooniegoogoo|key ID|ciphertext';

                assert.strictEqual(result[0], expectedResult0);
                assert.strictEqual(result[1], expectedResult1);
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1*2);
                assert.strictEqual(handler._encryptSenderKey.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 4*2);
                assert.strictEqual(ns._signMessage.callCount, 1*2);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });

            it("keyed, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', ED25519_PRIV_KEY);
                sandbox.stub(window, 'u_pubEd25519', ED25519_PUB_KEY);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('67lptSuY') });
                sandbox.stub(handler, '_encryptSenderKey').returns({
                    recipients: '\u0004\u0000\u0000\u0008' + base64urldecode('you456789xw'),
                    keys: '\u0005\u0000\u0000\u0010' + atob('yJrGOPeYvAg4iTeYqW7New=='),
                    keyIds: '\u0006\u0000\u0000\u0004' + KEY_ID
                });
                sandbox.stub(ns, '_signMessage').returns(INITIAL_MESSAGE.signature);
                var result = handler.encryptTo('Hello!', 'you456789xw');
                assert.strictEqual(btoa(result[0]), btoa(INITIAL_KEY_MESSAGE_BIN));
                assert.strictEqual(result[0].length, 130);
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });

            it("keyed, key reminder on reaching total message count, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID_1;
                var obj = {};
                obj[KEY_ID_0] = KEY;
                obj[KEY_ID_1] = ROTATED_KEY;

                handler.participantKeys['me3456789xw'] = obj;
                handler._sentKeyId = KEY_ID_1;
                handler._keyEncryptionCount = 5;
                handler._totalMessagesWithoutSendKey = 30;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', ED25519_PRIV_KEY);
                sandbox.stub(window, 'u_pubEd25519', ED25519_PUB_KEY);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: ROTATED_KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('H78adfMY') });

                var result = handler.encryptTo('Hello!', 'you456789xw');
                assert.strictEqual(result[0].length, 134);
                assert.strictEqual(handler.keyId, KEY_ID_1);
                assert.strictEqual(handler._sentKeyId, KEY_ID_1);

                var expectedParticipantKeys = { 'me3456789xw' : obj };

                assert.deepEqual(handler.participantKeys, expectedParticipantKeys);
                assert.strictEqual(handler._keyEncryptionCount, 6);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 1);
            });

            it("keyed, key reminder on reaching total message count, no content, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = ROTATED_KEY_ID;
                handler.participantKeys = { 'me3456789xw':
                    { 'AI\u0000\u0000': KEY, 'AI\u0000\u0001': ROTATED_KEY } };
                handler._sentKeyId = ROTATED_KEY_ID;
                handler._keyEncryptionCount = 5;
                handler._totalMessagesWithoutSendKey = 30;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', ED25519_PRIV_KEY);
                sandbox.stub(window, 'u_pubEd25519', ED25519_PUB_KEY);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: ROTATED_KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: null });
                sandbox.stub(ns, '_signMessage').returns(REMINDER_MESSAGE.signature);

                var result = handler.encryptTo(null, 'you456789xw');
                assert.strictEqual(btoa(result[0]), btoa(REMINDER_MESSAGE_BIN));
                assert.strictEqual(result[0].length, 130);
                assert.strictEqual(handler.keyId, ROTATED_KEY_ID);
                assert.strictEqual(handler._sentKeyId, ROTATED_KEY_ID);
                assert.deepEqual(handler.participantKeys,
                    { 'me3456789xw': { 'AI\u0000\u0000': KEY,
                                       'AI\u0000\u0001': ROTATED_KEY } });
                assert.strictEqual(handler._keyEncryptionCount, 5);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 1);
            });

            it("followup message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = 'key ID';
                handler.participantKeys['me3456789xw']['key ID'] = 'sender key';
                handler._sentKeyId = 'key ID';
                handler._keyEncryptionCount = 1;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', 'private Ed');
                sandbox.stub(window, 'u_pubEd25519', 'public Ed');
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: 'sender key', nonce: 'gooniegoogoo', ciphertext: 'ciphertext' });
                sandbox.stub(ns, '_signMessage').returns('squiggle');
                sandbox.stub(tlvstore, 'toTlvRecord');
                tlvstore.toTlvRecord.withArgs('\u0001').returns('|squiggle');
                tlvstore.toTlvRecord.withArgs('\u0002').returns('|0x01');
                tlvstore.toTlvRecord.withArgs('\u0003').returns('|gooniegoogoo');
                tlvstore.toTlvRecord.withArgs('\u0006').returns('|key ID');
                tlvstore.toTlvRecord.withArgs('\u0007').returns('|ciphertext');

                var result = handler.encryptTo('Hello!', 'you456789xw');
                var expectedResult = PROTOCOL_VERSION_STRING + '|squiggle|0x01|gooniegoogoo|key ID|ciphertext';
                assert.strictEqual(result[0], expectedResult);
                assert.strictEqual(ns._symmetricEncryptMessage.callCount, 1);
                assert.strictEqual(tlvstore.toTlvRecord.callCount, 5);
                assert.strictEqual(ns._signMessage.callCount, 1);
                assert.strictEqual(handler._sentKeyId, handler.keyId);
                assert.strictEqual(handler._keyEncryptionCount, 2);
            });

            it("followup, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.keyId = KEY_ID;
                handler.participantKeys['me3456789xw'][KEY_ID] = KEY;
                handler._sentKeyId = KEY_ID;
                handler._keyEncryptionCount = 1;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', ED25519_PRIV_KEY);
                sandbox.stub(window, 'u_pubEd25519', ED25519_PUB_KEY);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('67lptSuY') });
                sandbox.stub(ns, '_signMessage').returns(FOLLOWUP_MESSAGE.signature);

                var result = handler.encryptTo('Hello!', 'you456789xw');
                assert.strictEqual(btoa(result), btoa(FOLLOWUP_MESSAGE_BIN));
                assert.strictEqual(result[0].length, 108);
                assert.strictEqual(handler._keyEncryptionCount, 2);
            });

            it("rotate keys, binary", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.rotateKeyEvery = 3;
                handler.keyId = KEY_ID_0;
                handler.participantKeys['me3456789xw'][KEY_ID_0] = KEY;
                handler._sentKeyId = KEY_ID_0;
                handler._keyEncryptionCount = 3;
                sandbox.stub(window, 'u_handle', 'me3456789xw');
                sandbox.stub(window, 'u_privEd25519', ED25519_PRIV_KEY);
                sandbox.stub(window, 'u_pubEd25519', ED25519_PUB_KEY);
                sandbox.stub(window, 'u_privCu25519', CU25519_PRIV_KEY);
                sandbox.stub(window, 'pubCu25519', { 'you456789xw': CU25519_PUB_KEY });
                sandbox.stub(handler, 'updateSenderKey', function() {
                    handler.keyId = KEY_ID_1;
                    handler.participantKeys['me3456789xw'][KEY_ID_1] = ROTATED_KEY;
                    handler.previousKeyId = KEY_ID_0;
                    handler._keyEncryptionCount = 0;
                });
                sandbox.stub(ns, '_symmetricEncryptMessage').returns(
                    { key: ROTATED_KEY, nonce: atob('71BrlkBJXmR5xRtM'),
                      ciphertext: atob('H78adfMY') });
                sandbox.stub(ns, '_signMessage').returns(ROTATION_MESSAGE.signature);

                var result = handler.encryptTo('Hello!', 'you456789xw');

                assert.strictEqual(btoa(result[0]), btoa(ROTATION_MESSAGE_BIN_PROTOCOL_1));
                assert.strictEqual(result[0].length, 158);
                assert.strictEqual(handler.keyId, KEY_ID_1);
                assert.strictEqual(handler._sentKeyId, KEY_ID_1);

                var obj = {'me3456789xw' : {}};
                obj['me3456789xw'][KEY_ID_0] = KEY;
                obj['me3456789xw'][KEY_ID_1] = ROTATED_KEY;

                assert.deepEqual(handler.participantKeys, obj);
                assert.strictEqual(handler._keyEncryptionCount, 1);
            });
        });

        describe('decryptFrom', function() {
            it("from first sender", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[KEY_ID] = KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(INITIAL_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.deepEqual(handler.otherParticipants, new Set(['me3456789xw']));
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY });
            });

            it("own first sent message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['you456789xw']);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[KEY_ID] = KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(INITIAL_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.deepEqual(handler.otherParticipants, new Set(['you456789xw']));
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY });
            });

            it("keyed message", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[KEY_ID] = KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(INITIAL_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY });
            });

            it("keyed message not from participant", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['other6789xw']);

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                    'Sender not in current participants: me3456789xw');
            });

            it("own keyed message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[KEY_ID] = KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(INITIAL_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY });
            });

            it("bad parsing", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: false,
                    senderKeys: {}
                });

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Incoming message not usable.');
            });

            it("bad protocol version", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var parsedMessage = testutils.clone(INITIAL_MESSAGE);
                parsedMessage.protocolVersion = 254;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: parsedMessage, senderKeys: {}
                });

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Message not compatible with current protocol version.');
            });

            it("bad signature", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                sandbox.stub(handler, '_parseAndExtractKeys').returns(false);

                var result = handler.decryptFrom(INITIAL_MESSAGE_BIN, 'me3456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Message signature invalid.');
            });

            // Alter participants is going to be phased out, and is not currently in use live
            /*it("alter participants, me included, one excluded", function() {
            /*it("alter participants, me included, one excluded", function() {
                sandbox.stub(ns._logger, '_log');
                sandbox.stub(window, 'u_handle', 'lino56789xw');
                var handler = new ns.ProtocolHandler(u_handle,
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'lino56789xw': ED25519_PUB_KEY });
                handler.keyId = KEY_ID;
                handler.participantKeys['lino56789xw'][KEY_ID] = KEY;
                var senderKeys = {};
                senderKeys[ROTATED_KEY_ID] = ROTATED_KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(PARTICIPANT_CHANGE_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');
                sandbox.stub(handler, 'updateSenderKey', function() {
                    handler.keyId = ROTATED_KEY_ID;
                    handler.participantKeys['lino56789xw'][ROTATED_KEY_ID] = ROTATED_KEY;
                    handler.previousKeyId = KEY_ID;
                    handler._keyEncryptionCount = 0;
                });

                var result = handler.decryptFrom('binary stuff', 'me3456789xw');

                assert.deepEqual(result, {
                    sender: 'me3456789xw',
                    type: 0x02,
                    payload: 'Hello!',
                    includeParticipants: ['lino56789xw'], excludeParticipants: ['otto56789xw']
                });
                 console.log("ANDRE SAYS 2");
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.strictEqual(handler.updateSenderKey.callCount, 1);
                assert.deepEqual(handler.participantKeys['lino56789xw'],
                    { 'AI\u0000\u0000': KEY, 'AI\u0000\u0001': ROTATED_KEY });
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0001': ROTATED_KEY });
                assert.ok(setutils.equal(handler.otherParticipants,
                    new Set(['me3456789xw'])),
                    'mismatching other participants on handler');
                assert.ok(setutils.equal(handler.includeParticipants,
                    new Set(['lino56789xw'])),
                    'mismatching included participants');
                assert.ok(setutils.equal(handler.excludeParticipants,
                    new Set(['otto56789xw'])),
                    'mismatching excluded participants');
                assert.strictEqual(ns._logger._log.args[0][0],
                    'Particpant change received, updating sender key.');
            });*/

            it("alter participants, one included, me excluded", function() {
                sandbox.stub(ns._logger, '_log');
                sandbox.stub(window, 'u_handle', 'otto56789xw');
                var handler = new ns.ProtocolHandler(u_handle,
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'otto56789xw': ED25519_PUB_KEY });
                handler.keyId = KEY_ID;
                handler.participantKeys[u_handle][KEY_ID] = KEY;
                handler.otherParticipants = new Set(['me3456789xw']);
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(PARTICIPANT_CHANGE_MESSAGE),
                    senderKeys: {}
                });

                var result = handler.decryptFrom('binary stuff', 'me3456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(handler.keyId, null);
                assert.strictEqual(handler.otherParticipants.size, 0);
                assert.strictEqual(handler.includeParticipants.size, 0);
                assert.strictEqual(handler.excludeParticipants.size, 0);
                assert.strictEqual(ns._logger._log.args[0][0],
                    'I have been excluded from this chat, cannot read message.');
            });

            it("alter participants, one included, one excluded, not a member", function() {
                sandbox.stub(ns._logger, '_log');
                sandbox.stub(window, 'u_handle', 'noodle789xw');
                var handler = new ns.ProtocolHandler(u_handle,
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'noodle789xw': ED25519_PUB_KEY });
                handler.keyId = null;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(PARTICIPANT_CHANGE_MESSAGE),
                    senderKeys: {}
                });

                var result = handler.decryptFrom('binary stuff', 'me3456789xw');
                assert.strictEqual(result, false);
                assert.strictEqual(handler.keyId, null);
                assert.strictEqual(handler.otherParticipants.size, 0);
                assert.strictEqual(handler.includeParticipants.size, 0);
                assert.strictEqual(handler.excludeParticipants.size, 0);
                assert.strictEqual(ns._logger._log.args[0][0],
                    'I am not participating in this chat, cannot read message.');
            });

            it("followup message", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.participantKeys = { 'me3456789xw': { 'AI\u0000\u0000': KEY } };
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[ROTATED_KEY_ID] = ROTATED_KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(FOLLOWUP_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(FOLLOWUP_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 1,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
            });

            it("own followup message", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.participantKeys = { 'me3456789xw': { 'AI\u0000\u0000': KEY } };
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[ROTATED_KEY_ID] = ROTATED_KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(FOLLOWUP_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(FOLLOWUP_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 1,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
            });

            it("followup message, missing sender key", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(FOLLOWUP_MESSAGE),
                    senderKeys: {}
                });

                var result = handler.decryptFrom(FOLLOWUP_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Encryption key for message from *** with ID *** unavailable.');
                assert.strictEqual(ns._logger._log.args[1][0],
                                   'Encryption key for message from me3456789xw with ID QUkAAA unavailable.');
            });

            it("own followup message, missing sender key", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.participantKeys['me3456789xw'][0] = undefined;
                handler.participantKeys['me3456789xw'][1] = 'foo';
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(FOLLOWUP_MESSAGE),
                    senderKeys: {}
                });

                var result = handler.decryptFrom(FOLLOWUP_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Encryption key for message from *** with ID *** unavailable.');
                assert.strictEqual(ns._logger._log.args[1][0],
                                   'Encryption key for message from me3456789xw with ID QUkAAA unavailable.');
            });

            it("rotation message, old and new sender key", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[KEY_ID] = KEY;
                senderKeys[ROTATED_KEY_ID] = ROTATED_KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(ROTATION_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(ROTATION_MESSAGE_BIN_PROTOCOL_1, 'me3456789xw');
                assert.deepEqual(result, {
                    version: 0,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: 'Hello!',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY, 'AI\u0000\u0001': ROTATED_KEY });
            });

            it("produces key reminder on total count", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler._keyEncryptionCount = 5;
                handler._totalMessagesWithoutSendKey = 30;
                handler.encryptTo = sinon.stub().returns('key reminder message');
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[KEY_ID] = KEY;
                senderKeys[ROTATED_KEY_ID] = ROTATED_KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(ROTATION_MESSAGE),
                    senderKeys: senderKeys
                });
                sandbox.stub(ns, '_symmetricDecryptMessage').returns('Hello!');

                var result = handler.decryptFrom(ROTATION_MESSAGE_BIN_PROTOCOL_1, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V0,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: 'Hello!',
                    // toSend: 'key reminder message',
                    includeParticipants: [], excludeParticipants: []
                });
                assert.strictEqual(ns._symmetricDecryptMessage.callCount, 1);
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY, 'AI\u0000\u0001': ROTATED_KEY });
            });

            it("key reminder message", function() {
                var handler = new ns.ProtocolHandler('you456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.participantKeys = {'me3456789xw':
                    { 'AI\u0000\u0000': KEY, 'AI\u0000\u0001': ROTATED_KEY } };
                handler._totalMessagesWithoutSendKey = 5;
                sandbox.stub(window, 'pubEd25519', { 'me3456789xw': ED25519_PUB_KEY });
                var senderKeys = {};
                senderKeys[ROTATED_KEY_ID] = ROTATED_KEY;
                sandbox.stub(handler, '_parseAndExtractKeys').returns({
                    parsedMessage: testutils.clone(REMINDER_MESSAGE),
                    senderKeys: senderKeys
                });

                var result = handler.decryptFrom(REMINDER_MESSAGE_BIN, 'me3456789xw');
                assert.deepEqual(result, {
                    version: PROTOCOL_VERSION_V1,
                    sender: 'me3456789xw',
                    type: 0,
                    payload: null,
                    includeParticipants: [], excludeParticipants: []
                });
                assert.deepEqual(handler.participantKeys['me3456789xw'],
                    { 'AI\u0000\u0000': KEY, 'AI\u0000\u0001': ROTATED_KEY });
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 5);
            });
        });

        describe('batchDecrypt', function() {
            it("keyed message", function() {
                // This mock-history contains chatd as well as parsed data in one object.
                // The attribute `keys` just needs to be there to avoid an exception.
                var history = [
                    { userId: 'me3456789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      message: 'AI01readable', recipients: ['you456789xw'], keyIds: ['AI01'] },
                    { userId: 'me3456789xw', ts: 1444255634, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AI01readable', keyIds: ['AI01'] },
                    { userId: 'you456789xw', ts: 1444255635, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AIf1not readable', keyIds: ['AIf1'] },
                    { userId: 'me3456789xw', ts: 1444255636, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      message: 'AI02readable', recipients: ['you456789xw'], keyIds: ['AI02', 'AI01'] },
                    { userId: 'you456789xw', ts: 1444255637, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AIf1not readable', keyIds: ['AIf1'] },
                    { userId: 'you456789xw', ts: 1444255638, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AIf2not readable', keyIds: ['AIf2', 'AIf1'] },
                ];
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_batchParseAndExtractKeys', function() {
                    handler.participantKeys = {
                        'me3456789xw': { 'AI01': 'my key 1', 'AI02': 'my key 2' }
                    };
                });
                sandbox.stub(handler, 'decryptFrom', function(message, sender) {
                    var keyId = message.substring(0, 4);
                    message = message.substring(4);
                    var result;
                    if (this.participantKeys[sender] && this.participantKeys[sender][keyId]) {
                        result = { sender: sender, type: 42, payload: message };
                    }
                    else {
                        result = false;
                    }

                    return result;
                });

                var result = handler.batchDecrypt(history);
                assert.strictEqual(handler._batchParseAndExtractKeys.callCount, 1);
                assert.strictEqual(handler._totalMessagesWithoutSendKey, 0);
                for (var i = 0; i < history.length; i++) {
                    assert.strictEqual(handler.decryptFrom.args[i][2], true);
                    if (history[i].message.substring(4) === 'readable') {
                        assert.deepEqual(result[i],
                            { sender: 'me3456789xw', type: 42, payload: 'readable' });
                    }
                    else {
                        assert.strictEqual(result[i], false);
                    }
                }
            });

            it("keyed message, non-historic", function() {
                // This mock-history contains chatd as well as parsed data in one object.
                // The attribute `keys` just needs to be there to avoid an exception.
                var history = [
                    { userId: 'me3456789xw', ts: 1444255633, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      message: 'AI01readable', recipients: ['you456789xw'], keyIds: ['AI01'] },
                    { userId: 'me3456789xw', ts: 1444255634, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AI01readable', keyIds: ['AI01'] },
                    { userId: 'you456789xw', ts: 1444255635, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AIf1not readable', keyIds: ['AIf1'] },
                    { userId: 'me3456789xw', ts: 1444255636, type: ns.MESSAGE_TYPES.GROUP_KEYED,
                      message: 'AI02readable', recipients: ['you456789xw'], keyIds: ['AI02', 'AI01'] },
                    { userId: 'you456789xw', ts: 1444255637, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AIf1not readable', keyIds: ['AIf1'] },
                    { userId: 'you456789xw', ts: 1444255638, type: ns.MESSAGE_TYPES.GROUP_FOLLOWUP,
                      message: 'AIf2not readable', keyIds: ['AIf2', 'AIf1'] },
                ];
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                sandbox.stub(handler, '_batchParseAndExtractKeys', function() {
                    handler.participantKeys = {
                        'me3456789xw': { 'AI01': 'my key 1', 'AI02': 'my key 2' }
                    };
                });
                sandbox.stub(handler, 'decryptFrom', function(message, sender) {
                    var keyId = message.substring(0, 4);
                    message = message.substring(4);
                    var result;
                    if (this.participantKeys[sender] && this.participantKeys[sender][keyId]) {
                        result = { sender: sender, type: 42, payload: message };
                    }
                    else {
                        result = false;
                    }

                    return result;
                });

                var result = handler.batchDecrypt(history, false);
                assert.strictEqual(handler._batchParseAndExtractKeys.callCount, 1);
                for (var i = 0; i < history.length; i++) {
                    assert.strictEqual(handler.decryptFrom.args[i][2], false);
                    if (history[i].message.substring(4) === 'readable') {
                        assert.deepEqual(result[i],
                            { sender: 'me3456789xw', type: 42, payload: 'readable' });
                    }
                    else {
                        assert.strictEqual(result[i], false);
                    }
                }
            });
        });

        // Alter participants is going to be phased out, and is not currently in use live
        describe('alterParticipants', function() {
            it("nothing to do", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['you456789xw']);

                var result = handler.alterParticipants([], []);
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'No participants to include or exclude.');
            });

            it("include self", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['you456789xw']);

                var result = handler.alterParticipants(['me3456789xw'], []);
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Cannot include myself to a chat.');
            });

            it("exclude self", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['you456789xw']);

                var result = handler.alterParticipants([], ['me3456789xw']);
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'Cannot exclude myself from a chat.');
            });

            it("include existent", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['you456789xw']);

                var result = handler.alterParticipants(['you456789xw'], []);
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'User you456789xw already participating, cannot include.');
            });

            it("exclude non-existent", function() {
                sandbox.stub(ns._logger, '_log');
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['you456789xw']);

                var result = handler.alterParticipants([], ['other6789xw']);
                assert.strictEqual(result, false);
                assert.strictEqual(ns._logger._log.args[0][0],
                                   'User other6789xw not participating, cannot exclude.');
            });

            it("include lino", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);

                sandbox.stub(window, 'base64urldecode', _echo);
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecordWType);

                var result = handler.alterParticipants(['lino56789xw'], []);
                assert.strictEqual(result,
                    '\u0001|\u0002:\u0002|\u0008:lino56789xw');
            });

            it("exclude otto", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['otto56789xw']);

                sandbox.stub(window, 'base64urldecode', _echo);
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecordWType);
                sandbox.stub(handler, '_signContent', function(content) {
                    return '|squiggle' + content;
                });

                var result = handler.alterParticipants([], ['otto56789xw']);
                assert.strictEqual(result,
                    '\u0001|\u0002:\u0002|\u0009:otto56789xw');
            });

            it("include lino, exclude otto", function() {
                var handler = new ns.ProtocolHandler('me3456789xw',
                    CU25519_PRIV_KEY, ED25519_PRIV_KEY, ED25519_PUB_KEY, UNIQUE_DEVICE_ID);
                handler.otherParticipants = new Set(['otto56789xw']);

                sandbox.stub(window, 'base64urldecode', _echo);
                sandbox.stub(tlvstore, 'toTlvRecord', _toTlvRecordWType);

                var result = handler.alterParticipants(['lino56789xw'], ['otto56789xw'], 'Hello!');
                assert.strictEqual(result,
                    '\u0001|\u0002:\u0002|\u0008:lino56789xw|\u0009:otto56789xw');
            });
        });
    });
});
