/**
 * The most dummies lazy load ever... but no need for something more complicated, until we get the new __(...)
 */
var getMessageString;
(function() {
    var MESSAGE_STRINGS;
    getMessageString = function(type) {
        if (!MESSAGE_STRINGS) {
            MESSAGE_STRINGS = {
                'outgoing-call': l[5891],
                'incoming-call': l[5893],
                'call-timeout': l[5890],
                'call-starting': l[7206],
                'call-feedback': l[7998],
                'call-initialising': l[7207],
                'call-ended': [l[5889], l[7208]],
                'call-failed-media': l[7204],
                'call-failed': [l[7209], l[7208]],
                'call-handled-elsewhere': l[5895],
                'call-missed': l[7210],
                'call-rejected': l[5892],
                'call-canceled': l[5894],
                'call-started': l[5888]
            };
        }
        return MESSAGE_STRINGS[type];
    }
})();

module.exports = {
    getMessageString
};
