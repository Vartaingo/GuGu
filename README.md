# GuGu Framework
You can use this framework for easy start to mvc.

### The GuGu file structure must be like this
```
Application
│
├── system
│    ├── controllers
│    │   └── exampleController.php
│    │   └── others...
│    │    
│    ├── core
│    │    ├── config.php
│    │    ├── controller.php
│    │    ├── core.php
│    │    ├── model.php
│    │    └── view.php
│    │     
│    ├── models
│    │   ├── exampleModel.php
│    │   └── others...
│    │    
│    ├── modules
│    │   ├── system
│    │   └── others...
│    │    
│    └── views
│        ├── layout.html
│        └── others...
│       
├── index.php
│
└──config.json
```
### Config.json
config.json file must be like this.
```json
{
  "URL": "http://localhost",
  "DATABASE": {
    "HOST": "localhost",
    "NAME": "database",
    "CHARSET": "utf8",
    "USER": "root",
    "PASSWORD": "root"
  },
  "MAIL": {
    "HOST": "example.com",
    "PORT": 465,
    "SECURITY_PROTOCOL":"ssl",
    "LANG_CODE": "tr",
    "CHARSET": "utf-8",
    "ADDRESS": "example@example.com",
    "PASSWORD": "pass"
    },
  "ADMIN":{
    "MAIL":"example@example.com"
  },
  "DEFAULTS":{
    "CLASS":"main",
    "ACTION":"show",
    "LAYOUT":"layout.html"
  }
}
```
