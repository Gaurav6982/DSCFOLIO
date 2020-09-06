import React, { Component } from 'react';
import LinkSet1 from './LinkSet1.js';
import SocialMediaLinks from './SocialMediaLinks.js';
import LinkSet2 from './LinkSet2.js';
import ReactDOM from 'react-dom';
export class Portfolio extends Component {
  constructor(props){
    super(props);

    this.state = {
      loading: true,
      person: {},
    };

  }

 async componentWillMount() {
     console.log(window.location.pathname);
   const url = `/details${window.location.pathname}`;
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
                <div className="row">
                  <div className="col-lg-5" style={{marginTop:'30px'}}>
                    <center>
                        <img src={this.state.person.profile_picture} style={{textAlign:'center',height:'240px',width:'auto',paddingBottom:'30px'}} alt="img"/>
                        <p style={{fontSize:'22px',fontFamily: 'Airbnb Cereal App'}}>Hi, My name is {this.state.person.display_name}</p>
                        <p style={{fontSize:'16px',fontFamily: 'Airbnb Cereal App',color: '#989898'}}>{this.state.person.description}</p>
                          <div className="row">
                              <div className="mx-auto">
                                  <SocialMediaLinks socialLinks={this.state.person}/>
                              </div>
                          </div>
                    </center>
                  </div>
                  <div className="col-lg-7">
                    <div className="pr-1 pl-3">
                      <div className="w-100">
                        <div><span style={{fontSize:'22px',fontFamily: 'Airbnb Cereal App'}}>{this.state.person.link_set1_name}</span>


                          <a href={this.state.person.resume} style={{margin:'10px',float:'right'}}><img src="https://i.ibb.co/qscVm9v/Group-116.jpg" style={{width:'auto',height:'40px'}}/></a>
                        </div>
                      </div>
                      <LinkSet1 projectLinks={this.state.person}/>
                      <br/>
                      <span style={{fontSize:'22px',fontFamily: 'Airbnb Cereal App'}}>{this.state.person.link_set2_name}</span>
                      <LinkSet2 blogLinks={this.state.person}/>

                    </div>
                  </div>
                </div>

            </div>
        )
    }
}

export default Portfolio
if (document.getElementById('shared')) {
    ReactDOM.render(<Portfolio />, document.getElementById('shared'));
}
