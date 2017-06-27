# CONTROL PANEL
###### DOMAINS MANAGING MADE EASY

### FEATURES
#### MANAGE DOMAINS
A domain is made of a _name_, _registration date_, an _IP_ and a _list of relationships_.
> a **domain** has many **emails**  
> a **domain** has many **databases**  
> a **domain** has many **sub-domains**  
> a **domain** belongs to a **maintainer**  
> a **domain** belongs to a **hosting**  
> a **domain** has many **webapps**
---
##### MANAGE SUB-DOMAINS
A sub-domain is made of a _name_ and a _list of relationships_.
> a **sub-domain** belongs to a **domain**  
> a **sub-domain** has many **apps**
---
##### MANAGE EMAILS
An email is made of a _name_ (_example_@domain.com), a _password_ and the _domain relationship_.
> an **email** belongs to a **domain**
---
##### MANAGE DATABASES
A database is made of a _name_, a _username_, a _password_ and a _domain relationship_.
> a **database** belongs to a **domain**
---
##### MANAGE MAINTAINERS (domain name registration)
A maintainer is made of a _name_, account information: _username_ and _password_, a _website_, additional _information_.
> a **maintainer** has many **domains**
---
##### MANAGE HOSTING (server where the domain point)
A hosting is made of a _name_, account information: _username_ and _password_, a _website_, additional _information_.
> a **hosting** has many **domains**
---
##### MANAGE WEBAPPS (installed on domain)
An app is made of a _name_ (Wordpress, etc...), account information: _username_ and _password_, _additional information_ and _domain relationship_.
> a **webapp** belongs to a **domain** or **sub-domain**