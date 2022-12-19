import { Controller } from '@hotwired/stimulus';
import { ZoomMtg } from '@zoomus/websdk';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        'sdkKey': String,
        'sdkSecret': String,//TODO: hada 3endo xi 7el bax itekheba
        'config': Array
    }

    connect() {
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.9.5/lib', '/av');
        ZoomMtg.setZoomJSLib('https://jssdk.zoomus.cn/2.9.5/lib', '/av');

        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareWebSDK();

        // get meeting args from url
        let {
            meetingNumber,
            userName,
            passWord,
            leaveUrl,
            role,
            userEmail,
            lang,
        } = this.configValue;

        ZoomMtg.generateSDKSignature({
            meetingNumber: meetingNumber,
            sdkKey: this.sdkKeyValue,
            sdkSecret: this.sdkSecretValue,
            role: role,
            success: function (res) {
                let signature = res.result;
                ZoomMtg.init({
                    leaveUrl: leaveUrl ?? window.location,
                    disableCORP: !window.crossOriginIsolated,
                    success: function () {
                        ZoomMtg.i18n.load(lang);
                        ZoomMtg.i18n.reload(lang);
                        ZoomMtg.join({
                            meetingNumber: meetingNumber,
                            userName: userName,
                            signature: signature,
                            sdkKey: this.sdkKeyValue,
                            userEmail: userEmail,
                            passWord: passWord,
                            success: function (res) {
                                //join the meeting successfully
                                ZoomMtg.getAttendeeslist({
                                    success: function (res) {
                                        //get attendees list successfully
                                    },
                                    error: function (res) {
                                        console.error('ZoomMtg.getAttendeeslist error : ',res);
                                    }
                                });
                                ZoomMtg.getCurrentUser({
                                    success: function (res) {
                                        //get current user successfully
                                    },
                                    error: function (res) {
                                        console.error('ZoomMtg.getCurrentUser error : ',res);
                                    }
                                });
                            },
                            error: function (res) {
                                console.error('ZoomMtg.join error : ',res);
                            },
                        });
                    },
                    error: function (res) {
                        console.error('ZoomMtg.init error : ',res);
                    },
                });
            },
            error: function (res) {
                console.error('ZoomMtg.generateSDKSignature error : ',res);
            },
        });
    }
}
