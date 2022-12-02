import React from "react";

import DeviceIcon from "./DeviceIcon";
import DeviceServiceList from "./DeviceServiceList";

class Device extends React.Component
{
    render() {
        return (
            <div className="col-lg-4 mb-3">
                <div className="card">
                    <div className="card-body">
                        <h5 className="card-title">
                            <DeviceIcon deviceType={this.props.device.type} />
                            {this.props.device.name}
                        </h5>
                    </div>

                    <DeviceServiceList services={this.props.device.services} />
                </div>
            </div>
        );
    }
}

export default Device;