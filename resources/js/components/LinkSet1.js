import React, { Component } from 'react'
import {CopyToClipboard} from 'react-copy-to-clipboard';

export class LinkSet1 extends Component {
  constructor(props){
    super(props);

    this.state={
      copied: false,
    };
  }
    render() {
      const linkset1 = this.props.projectLinks.set1_links.map((linkset)=> {
        return (
          <div className="card" key={linkset.id}>
          <div className="card-body">
              <h6>{linkset.link_heading}</h6>
              <p>{linkset.link_url}</p>
              <CopyToClipboard className="mr-auto" text={linkset.link_url} onCopy={() => this.setState({copied: true})}>
                <button>Copy</button>
              </CopyToClipboard>
              <a href={linkset.link_url} target="_blank">   Go</a>
              {this.state.copied ? <span style={{color: 'green'}}>Copied.</span> : null}
          </div>
        </div>
        );
      });
      return(
        <div>{linkset1}</div>
        );
    }
}

export default LinkSet1
