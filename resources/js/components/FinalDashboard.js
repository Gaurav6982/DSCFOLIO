import React, { Component } from 'react';
import LinkSet1 from './LinkSet1.js';
import SocialMediaLinks from './SocialMediaLinks.js';
import LinkSet2 from './LinkSet2.js';
//import {DATA} from '../data.js';
import ReactDOM from 'react-dom';
export class FinalDashboard extends Component {
  constructor(props){
    super(props);

    this.state = {
      loading: true,
      person: {},
    };
  }

 async componentDidMount() {
   const url = "/details";
   const response = await fetch(url);
   const data = await response.json();
   this.setState({ person: data, loading: false });
 }

    render() {
        if (this.state.loading) {
          return <div>loading...</div>;
        }
        return (
            <div className="container" style={{backgroudColor:'#f5f5f5'}}>
                <div class="row">
                  <div class="col-lg-5">
                    <center>
                        <img src="assets/images/Avatar1.svg" style={{textAlign:'center',maxHeight:'70%',maxWidth:'70%',paddingBottom:'30px'}} alt="img"/>
                        <h3>{this.state.person.display_name}</h3>
                        <p>{this.state.person.description}</p>
                        <div className="row">
                            <div className="mx-auto">
                                <SocialMediaLinks socialLinks={this.state.person}/>
                            </div>
                        </div>
                    </center>
                  </div>
                  <div className="col-lg-7">
                    <button><a target="_blank" href="https://www.biowritingservice.com/writing-professional-bio-software-engineer/">Resume</a></button>
                    <h5><strong>{this.state.person.link_set1_name}</strong></h5>
                    <LinkSet1 projectLinks={this.state.person}/>
                    <br/>
                    <h5><strong>{this.state.person.link_set2_name}</strong></h5>
                    <LinkSet2 blogLinks={this.state.person}/>
                  </div>
                </div>
            </div>
        )
    }
}

export default FinalDashboard
if(document.getElementById("finaldashboard")){
    ReactDOM.render(<FinalDashboard />,document.getElementById("finaldashboard"));
}




