import React, { Component } from 'react'
import Intro from './Intro';
import HowToUse from './HowToUse';
import About from './About';
import Footer from './Footer';
import PWA from './PWA';


export class Home extends Component {
    render() {
        return (
            <div>
                <Intro/>
                <About/>
                <HowToUse/>
                <PWA/>
                <Footer/>
            </div>
        )
    }
}

export default Home
