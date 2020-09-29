import React, { Component } from 'react'
import {getJwt} from '../helpers/jwt';
import axios from 'axios';

export class Authentication extends Component {
    constructor(props){
        super(props);
    
        this.state = {
          user: undefined
        };
      }

      componentDidMount(){
          const jwt=getJwt();
          if(!jwt){
              this.props.history.push('/login');
          }
          axios.get('/api/user/',{headers: {Authorization: `Bearer ${jwt}`}}).then(res=>res.setState({
              user:res.data
          })).catch(err=>{
              localStorage.removeItem('token');
              this.props.history.push('/login');
          });
      }

    render() {
        if(this.state.user===undefined){
            return(
                <div><h5>Loading...</h5></div>
            );
        }
        return (
            <div>
                {this.props.children}
            </div>
        )
    }
}

export default Authentication;
