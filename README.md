My default project for Yii2. #Bootstrap3 #Less #Usuario #Admin_panel
==============================

### Install project
```
composer create-project --prefer-dist --stability=dev grozzzny/start_project_b3_less www dev-master
```

### Run migrations
```
php yii migrate
```

### Create user
```
yii user/create <email> <username> [password] [administrator]
```

### Admin panel and settings user
```
https://my-site.com/user/admin
https://my-site.com/admin
```

#### Modules, components and widgets
- User module. [Usuario](https://yii2-usuario.readthedocs.io/en/latest/) 
- Admin panel. [Dashboard](https://github.com/grozzzny/admin) 
- Assets. [Depends](https://github.com/grozzzny/depends) 

#### Style / less structure
- base
_base.less
_fonts.less
_variables.less
- bootstrap
_mixins.less
_variables.less
bootstrap.less
- fonts
- layout
_footer.less
_header.less
- pages
- partials
- sections
styles.less
```
@charset "UTF-8";

//Base
@import "base/_fonts.less";
@import "base/_variables.less";
@import "base/_base";

//Sections
//@import "sections/_tournaments";

//Layouts
//@import "layout/_header";

//Partials
//@import "partials/_nav-lang";

//Pages
//@import "pages/_about.less";
```
