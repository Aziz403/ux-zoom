import { Controller } from '@hotwired/stimulus';
import { ZoomMtg } from '@zoomus/websdk';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        'view': Object
    }

    connect() {
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.9.5/lib', '/av');
        ZoomMtg.setZoomJSLib('https://jssdk.zoomus.cn/2.9.5/lib', '/av');

        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareWebSDK();

        let { sdkKey, sdkSecret, config } = this.viewValue;
        console.log('config',config,this.viewValue)

        if(config.leaveUrl==='window.location'){
            config.leaveUrl = window.location;
        }

        ZoomMtg.generateSDKSignature({
            meetingNumber: config.meetingNumber,
            sdkKey: sdkKey,
            sdkSecret: sdkSecret,
            role: config.role,
            success: function (res) {
                let signature = res.result;
                ZoomMtg.init({
                    leaveUrl: config.leaveUrl,
                    disableCORP: !window.crossOriginIsolated,
                    success: function () {
                        ZoomMtg.i18n.load(config.lang);
                        ZoomMtg.i18n.reload(config.lang);
                        ZoomMtg.join({
                            meetingNumber: config.meetingNumber,
                            userName: config.userName,
                            signature: signature,
                            sdkKey: sdkKey,
                            userEmail: config.userEmail,
                            passWord: config.passWord,
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
