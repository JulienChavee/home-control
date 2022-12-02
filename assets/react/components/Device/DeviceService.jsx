import React from "react";
import Battery from "../Service/Battery";
import Light from "../Service/Light";

class DeviceService extends React.Component
{
    render()
    {
        let service = null;

        if (this.props.service.name === 'battery') {
            service = <Battery serviceId={this.props.service.id} key={this.props.service.id} />
        } else if (this.props.service.name === 'light') {
            service = <Light serviceId={this.props.service.id} key={this.props.service.id} />
        }

        return (
            <li className="list-group-item">
                {service}
            </li>
        )
    }
}

export default DeviceService;