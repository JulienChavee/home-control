import React from "react";

class DeviceIcon extends React.Component
{
    render()
    {
        let icon = null;
        if (this.props.deviceType === 'light_bulb') {
            icon = <i className="far fa-lightbulb me-1"></i>
        } else if (this.props.deviceType === 'motion_sensor') {
            icon = <i className="far fa-sensor me-1"></i>
        } else if (this.props.deviceType === 'light_spot') {
            icon = <i className="far fa-hockey-puck me-1"></i>
        } else if (this.props.deviceType === 'light_strip') {
            icon = <i className="far fa-project-diagram me-1"></i>
        } else if (this.props.deviceType === 'light_outdoor_wall') {
            icon = <i className="far fa-camera-home me-1"></i>
        } else if (this.props.deviceType === 'dimmer_switch') {
            icon = <i className="far fa-light-switch me-1"></i>
        }

        return (icon)
    }
}

export default DeviceIcon;