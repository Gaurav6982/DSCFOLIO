import React from 'react';
import MainComponent from './MainComponent';
import '../App.css';
import { BrowserRouter } from 'react-router-dom';
import ReactDOM from 'react-dom';
function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <MainComponent/>
      </div>
    </BrowserRouter>
  );
}

export default App
if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
