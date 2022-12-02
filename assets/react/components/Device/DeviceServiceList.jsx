import React from "react";
import DeviceService from "./DeviceService";

class DeviceServiceList extends React.Component
{
    render()
    {
        if (this.props.services.length > 0) {
            return (
                <ul className="list-group list-group-flush">
                    {this.props.services.map((service) => <DeviceService service={service} key={service.id} />)}
                </ul>
            )
        }
    }
}

export default DeviceServiceList;