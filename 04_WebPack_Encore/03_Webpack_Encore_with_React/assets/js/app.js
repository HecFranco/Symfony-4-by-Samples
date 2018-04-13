import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

import ItemCard from './Components/ItemCard';

class App extends React.Component {
  constructor() {
    super();

    this.state = {
      entries: []
    };
  }

  componentDidMount() {
    fetch('/data')
      .then(response => response.json())
      .then(entries => {
        this.setState({
          entries
        });
      });
  }

  render() {
    return (
      <MuiThemeProvider>
        <div style={{ display: 'flex' }}>
          {this.state.entries.map(
            ({ id, author, avatarUrl, title, description }) => (
              <ItemCard
                key={id}
                author={author}
                title={title}
                avatarUrl={avatarUrl}
                style={{ flex: 1, margin: 10 }}
              >
                {description}
              </ItemCard>
            )
          )}
        </div>
      </MuiThemeProvider>
    );
  }
}

ReactDOM.render(<App />, document.getElementById('root'));