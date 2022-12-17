import { Controller } from '@hotwired/stimulus';

/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static values = {
        'sdkKey': String,
        'sdkSecret': String,
        'config': Array
    }

    connect() {

    }
}
