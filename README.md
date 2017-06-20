# Bang Fitness Wordpress Theme 

### Requirements:
- node
- npm
- gulp
- bower

### Instructions:
Run the following commands in a terminal to get started:

```  
npm install -g gulp bower;
npm install;
bower install;
```

Then edit the file `themes/bangfitness/assets/manifest.json` to change the `config.devUrl` key to the hostname of the targeted Wordpress instance (such as `http://www.bangfitness.dev`, for example)

Finally run `gulp watch`, which will build the SASS and Javascript, and open a browser window with the auto-reloading built theme ready to go. Every time you make a change to the files the page will reload with the changes. The default URL to access this is `http://localhost:3000`