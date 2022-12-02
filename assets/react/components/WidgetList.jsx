import React from "react";
import Device from "./Device/Device";

class WidgetList extends React.Component
{
    render() {
        return (
            <div id="masonryContainer" className="row">
                {
                    this.props.devices.map((device) => <Device device={device} key={device.id} />)
                }
            </div>
        );
    }
}

export default WidgetList;