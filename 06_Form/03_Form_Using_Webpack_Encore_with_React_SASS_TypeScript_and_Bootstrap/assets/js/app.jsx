import '../scss/app.scss';
import React from 'react';
import ReactDOM from 'react-dom';

class Form extends React.Component {
  constructor(props) {
      super(props);
      this.state = {
          fullnameValue: '',
          emailValue: '',
          passwordValue: '',
          fullnameError: '',
          emailError: '',
          passwordError: '',
          successMessage: '',
      };
      this.handleChange = this.handleChange.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleChange(e) {
      if(e.target.name === 'fullname') {
          this.setState({
              fullnameValue: e.target.value
          });
      }

      if(e.target.name === 'email') {
          this.setState({
              emailValue: e.target.value,
          });
      }
      
      if(e.target.name === 'password') {
          this.setState({
              passwordValue: e.target.value,
          });
      }        
  }

  handleSubmit(e) {
      e.preventDefault();

      $.ajax({
          url: 'http://127.0.0.1:8000/api/user',
          type: 'POST',
          data: {
              fullname: this.state.fullnameValue,
              email: this.state.emailValue,
              password: this.state.passwordValue
          },
          dataType: 'json',
          success: function(response) {
              this.setState({
                  fullnameError: response.fullnameError ? response.fullnameError : null,
                  emailError: response.emailError ? response.emailError : null,
                  passwordError: response.passwordError ? response.passwordError : null,
                  successMessage: response.success_message ? response.success_message : null,
              });
          }.bind(this),
          error: function(xhr) {
              console.log(`An error occured: ${xhr.status} ${xhr.statusText}`);
          }
      });
  }

  render() {
      return (
          <form class="form-inline"  onSubmit={this.handleSubmit}>
            <div class="form-group">
              <label htmlFor="fullname">Fullname</label>
              <input class="form-control" type="text" name='fullname' value={this.state.fullnameValue} onChange={this.handleChange} id="fullname" placeholder="Fullname" />
              <small>{this.state.fullnameError}</small>
            </div>
            <div class="form-group">
              <label htmlFor="email">Email</label>
              <input class="form-control" type="email" name='email' value={this.state.emailValue} onChange={this.handleChange} id="email" placeholder="Email" />
              <small>{this.state.emailError}</small>
            </div>
            <div class="form-group">
              <label htmlFor="password">Password</label>            
              <input class="form-control" type="password" name='password' value={this.state.passwordValue} onChange={this.handleChange} id="password" placeholder="Password" />
              <small>{this.state.passwordError}</small>            
            </div>
              <button class="btn btn-primary" type="submit">Sign up</button>
              <span className='text-success'>{this.state.successMessage}</span>
          </form>
      );
  }
}

ReactDOM.render(<Form />, document.getElementById('root'));