import React from 'react';
import { createRoot } from 'react-dom/client';

const routes = require('../../../public/js/fos_js_routes.json');
import Routing from '../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min';
Routing.setRoutingData(routes);

import WidgetList from "../../react/components/WidgetList";

document.addEventListener("DOMContentLoaded", () => {
    loadDevices();
});

function loadDevices()
{
    fetch(
        Routing.generate('app_home_load_devices'),
        {
            method: "GET"
        }
    )
        .then(response => response.json())
        .then(body => {
            let container = document.getElementById('widgetListContainer');
            let root = createRoot(container);

            root.render(
                <WidgetList devices={body} />,
            );
        });
}