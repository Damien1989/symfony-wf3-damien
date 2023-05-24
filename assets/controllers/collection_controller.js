import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

initialize()
{
    console.log("Collection initialize");
}

    connect()
    {
        console.log("Collection connect");
    }
}