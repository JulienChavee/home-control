import React from "react";

const routes = require('../../../../public/js/fos_js_routes.json');
import Routing from '../../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min';
Routing.setRoutingData(routes);

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

class Battery extends React.Component
{
    state = {
        level: undefined,
        updateInError: false
    }

    render()
    {
        if (this.state.updateInError) {
            return (
                <>
                    <FontAwesomeIcon icon="far fa-exclamation-triangle" />
                    <span className="ms-1">An error occured while updating</span>
                </>
            )
        }

        if (this.state.level === undefined) {
            return (
                <div className="placeholder-glow">
                    <span className="placeholder col-4"></span>
                </div>
            )
        }

        let iconColor = 'text-success';
        let batteryIcon = <FontAwesomeIcon icon="far fa-battery-full" className={iconColor}></FontAwesomeIcon>;

        if (parseInt(this.state.level) <= 75) {
            batteryIcon = <FontAwesomeIcon icon="far fa-battery-three-quarters" className={iconColor}></FontAwesomeIcon>;
        }

        if (parseInt(this.state.level) <= 50) {
            iconColor = 'text-warning';
            batteryIcon = <FontAwesomeIcon icon="far fa-battery-half" className={iconColor}></FontAwesomeIcon>;
        }

        if (parseInt(this.state.level) <= 25) {
            iconColor = 'text-danger';
            batteryIcon = <FontAwesomeIcon icon="far fa-battery-quarter" className={iconColor}></FontAwesomeIcon>;
        }

        if (parseInt(this.state.level) <= 10) {
            iconColor = 'text-danger';
            batteryIcon = <FontAwesomeIcon icon="far fa-battery-empty" className={iconColor}></FontAwesomeIcon>;
        }

        return (
            <>
                {batteryIcon}
                <span className="ms-1">{this.state.level}%</span>
            </>
        )
    }

    componentDidMount() {
        setTimeout(
            () => {
                this.updateService();

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
                    serviceType : "battery",
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
                    level: body[0].level,
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

export default Battery;