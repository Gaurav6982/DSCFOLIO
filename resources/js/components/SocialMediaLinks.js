import React, { Component } from 'react'

export class SocialMediaLinks extends Component {
  constructor(props){
    super(props);

    this.state={
      copied: false,
    };
  }
    render() {
        if(this.props.social.link_name=="LinkedIn"){
            return (
                <div>
                    <a href=""><img src="assets/images/Mask Group.png" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                </div>
            );
        };
        if(this.props.social.link_name=="Twitter"){
            return (
                <div>
                    <a href=""><img src="assets/images/Mask Group(2).svg" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                </div>
            );
        };
        if(this.props.social.link_name=="Github"){
            return (
                <div>
                    <a href=""><img src="assets/images/Mask Group(3).svg" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                </div>
            );
        };
        if(this.props.social.link_name=="Behance"){
            return (
                <div>
                    <a href=""><img src="assets/images/Mask Group(4).svg" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                </div>
            );
        }
    }
}

export default SocialMediaLinks
