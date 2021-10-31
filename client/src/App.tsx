import { Component } from 'react';
import {BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Error from './components/Error/Error';
import './App.css';
import Posts from './components/Posts/Posts';
import Category from './components/Category/Category';

class App extends Component {
  render() {
    return (
      <Router>
        <Switch>
          <Route path="/posts" component={Posts}/>
          <Route path="/category" component={Category} />
          <Route component={() => (
            <Error />
          )}/>
        </Switch>
      </Router>
    );
  }
}

export default App;
