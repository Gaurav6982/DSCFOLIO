import React, { Component } from 'react'

export class SocialMediaLinks extends Component {
  constructor(props){
    super(props);

    this.state={
      copied: false,
    };
  }
    render() {
        const socialLinks = this.props.socialLinks.social_links.map((socialLink)=>{
            if(socialLink.link_name==="Behance"){
                return (
                    <div key={socialLink.id}>
                        <a href={socialLink.link_url}><img src="assets/images/Mask Group(4).svg" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                    </div>
                );
            };
            if(socialLink.link_name==="LinkedIn"){
                return (
                    <div key={socialLink.id}>
                        <a href={socialLink.link_url}><img src="assets/images/Mask Group.png" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                    </div>
                );
            };
            if(socialLink.link_name==="Github"){
                return (
                    <div key={socialLink.id}>
                        <a href={socialLink.link_url}><img src="assets/images/Mask Group(3).svg" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                    </div>
                );
            };
            if(socialLink.link_name==="Twitter"){
                return (
                    <div key={socialLink.id}>
                        <a href={socialLink.link_url}><img src="assets/images/Mask Group(2).svg" style={{width:'25px',height:'25px',margin:'5px'}}/></a>
                    </div>
                );
            };
        });

        return(
            <div>{socialLinks}</div>
        )
    }
}

export default SocialMediaLinks
