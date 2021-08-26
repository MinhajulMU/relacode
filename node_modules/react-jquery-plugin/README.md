# React jquery plugin
[![NPM](https://img.shields.io/npm/v/react-jquery-plugin.svg)](https://www.npmjs.com/package/prestein-dante) [![JavaScript Style Guide](https://img.shields.io/badge/code_style-standard-brightgreen.svg)](https://standardjs.com)

This tool will help you to use jquery plugins like `easing`, `ScrollMagic`, `Nice Select`,etc.. in react very easy. 

## Install

```bash
npm install --save react-jquery-plugin
```
## Usage

```jsx
import React, { Component } from 'react'

import { $ }  from 'react-jquery-plugin'

class Example extends Component {
  componentDidMount() {
    $(window).scroll(() => {
     // put your code here
    });
  }
  render () {
    return (
      <div>
        <h1>Hello there</h1>
      </div>
    )
  }
}
```

or 

```jsx
import React, { Component } from 'react'

import 'react-jquery-plugin'

class Example extends Component {
  componentDidMount() {
    window.$(window).scroll(() => {
     // put your code here
    });
  }
  render () {
    return (
      <div>
        <h1>Hello there</h1>
      </div>
    )
  }
}
```

## Show your support

Give a ⭐️ if you like this project!

## Acknowledgments

- I would like to thank our code reviewer and anyone else who participated in making this done.

## 📝 License

This project is [MIT](https://github.com/rukundoeric/covid19_updates_info_scraper/blob/scraper/LICENSE) licensed.