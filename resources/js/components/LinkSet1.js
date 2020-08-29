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
      const linkset1 = this.props.link_set_2.map((linkset)=> {
        return (
          <div class="card">
          <div class="card-body">
              <h6>{linkset.link_heading}</h6>
              <p>{linkset.link_url}</p>
              <CopyToClipboard className="mr-auto" text="likhere" onCopy={() => this.setState({copied: true})}>
                <button>Copy</button>
              </CopyToClipboard>
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
