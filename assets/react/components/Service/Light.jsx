import React from "react";

const routes = require('../../../../public/js/fos_js_routes.json');
import Routing from '../../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min';
Routing.setRoutingData(routes);

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

class Light extends React.Component
{
    state = {
        isOn: undefined,
        brightness: undefined,
        updateInError: false
    }

    render() {
        if (this.state.updateInError) {
            return (
                <>
                    <FontAwesomeIcon icon="far fa-exclamation-triangle" />
                    <span className="ms-1">An error occured while updating</span>
                </>
            )
        }

        if (this.state.isOn === undefined) {
            return (
                <div className="placeholder-glow">
                    <span className="placeholder col-4"></span>
                </div>
            )
        }

        let icon = null;

        if (this.state.isOn) {
            icon = <FontAwesomeIcon icon="far fa-lightbulb-on" className="text-warning" />
        } else {
            icon = <FontAwesomeIcon icon="far fa-lightbulb" className="text-muted" />
        }


        return (
            <>
                <span>
                    {icon}
                    <span className="ms-1">{this.state.isOn ? "Allumée - " + this.state.brightness + "%" : "Éteinte"}</span>
                </span>
            </>
        )
    }

    componentDidMount() {
        setTimeout(
            () => {
                this.updateService()

                this.timerID = setInterval(
                    () => this.updateService(),
                    60000
                );
            },
            Math.random() * 5 * 1000
        );
    }

    componentWillUnmount() {
        clearInterval(this.timerID);
    }

    updateService() {
        fetch(
            Routing.generate(
                'app_home_load_service',
                {
                    serviceType : "light",
                    serviceID : this.props.serviceId,
                }
            ),
            {
                method: "GET"
            }
        )
            .then(response => response.json())
            .then(body => {
                this.setState(prevState => ({
                    isOn: body[0].on,
                    brightness: body[0].dimming.brightness,
                    updateInError: false
                }))
            })
            .catch((error) => {
                this.setState(prevState => ({
                    updateInError: true
                }))
            });
    }
}

export default Light