import React, { Component } from 'react'
import {Button, Form, FormGroup, Input, Label, Col} from 'reactstrap';
import axios from 'axios';
import {Redirect} from 'react-router-dom';

export class SignIn extends Component {

    constructor(props) {
        super(props);

        this.state = {
            email: '',
            password: ''
        };

        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.value;
        const name = target.name;

        this.setState({
          [name]: value
        });
    }

    handleSubmit(event) {
        event.preventDefault();

        axios.post('/sign-in', {
            email: this.state.email,
            password: this.state.password
        })
        .then(function (response) {
            if(response.data=='success')
            window.location.href="/build";
            else if(response.data=='info')
            window.location.href="/final";
        })
        .catch(function (error) {
            console.log(error);
        });
        // if(userFound){
        //     return  <Redirect  to="/build/" />
        // }
    }

    render() {
        return (
            <Form onSubmit={this.handleSubmit}>
                <FormGroup row>
                    <Label htmlFor="email" md={3}>Email</Label>
                    <Col md={9}>
                        <Input type="text" id="email" name="email"
                            placeholder="Email" value={this.state.email}
                            onChange={this.handleInputChange} />
                    </Col>
                </FormGroup>
                <FormGroup row>
                    <Label htmlFor="password" md={3}>Password</Label>
                    <Col md={9}>
                        <Input type="password" id="password" name="password"
                            placeholder="Password" value={this.state.password}
                            onChange={this.handleInputChange}/>
                    </Col>
                </FormGroup><br/>
                <Button className="col-lg-12 buttons" type="submit" value="submit" color="primary">Sign In</Button>
            </Form>
        )
    }
}

export default SignIn
