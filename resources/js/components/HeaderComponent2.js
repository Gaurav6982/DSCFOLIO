import React, { Component } from 'react'
import { Navbar, NavbarBrand, Nav,NavItem,Button } from 'reactstrap';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom';
export class HeaderComponent2 extends Component {

    render() {
        
        return (
            <BrowserRouter>
            <div>
                <Navbar className="fixed-top navbar" color="white" light expand="lg">
                    <div className="container">
                        <NavbarBrand className="mr-auto" href="/">
                            <img  src="assets/images/logoSmall.svg"  height="29px"  width="153px" alt=""
                        />
                        </NavbarBrand>
                        <Nav navbar className="ml-auto" style={{float:'right',color:'#000000'}}>
                        <NavItem className="nav-items">
                            <button className="btn btn-primary" >Logout</button>
                        </NavItem>
                        </Nav>
                    </div>
                </Navbar>
            </div>
            </BrowserRouter>
        );
        
    }
}

export default HeaderComponent2
if (document.getElementById('logout1')) {
    ReactDOM.render(<HeaderComponent2 />, document.getElementById('logout1'));
}





















