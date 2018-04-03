Drop table Provider;
Drop table Member;
Drop table Review;
#
# The Provider table contains the service provider's name and profile.
# The profile fields are normally copied from the Review table when a new record
# is inserted there through insert.php. The values can be changed by the admin.
# More than one provider may share the same name; pname and create_time uniquely
# identifies a provider, as does the provider id (pid) primary key.
#
Create table Provider (
   pid          int            NOT NULL auto_increment,
   pname        varchar(32)    NOT NULL,
   create_time  timestamp      NOT NULL DEFAULT CURRENT_TIMESTAMP,
   update_time  timestamp      NOT NULL,
   location     varchar(32),
   website      varchar(128),
   adsite       varchar(128),
   photo        varchar(128),
   email        varchar(128),
   phone1       varchar(16),
   PRIMARY KEY(pid), UNIQUE( pname, create_time )       
);

#
# The Member table is temporary. When integrated, the member name
# comes from the membership table.
#
Create table Member (
   mid          int            NOT NULL auto_increment,
   mname        char(32)       NOT NULL,
   PRIMARY KEY(mid), UNIQUE(mname)
);

#
# The Review table may contain more than one review of a provider by each
# reveiwer (member).
# It conatins 2 parts:
#    (1) the review, which contains information specific for that session as
#        well as free-formed review text
#    (2) the provider's profile, which has the same attributes as that of the
#        provider table
# A review is uniquely identified by the provider id (pid), the member if (mid)
# and the review timestamp.
# The primary key is the review id (rid).
# Column "price" (named as such to avoid confusion with key "value")
# is displayed as "value" on the form.
#
Create table Review (
   rid          int            NOT NULL auto_increment,
   pid          int            NOT NULL,
   mid          int            NOT NULL,
   review_time  timestamp      NOT NULL,
   editable     char(1)        DEFAULT 'N',
   visit_date   date,
   visit_loc    varchar(32),
   duration     int,
   cost         int,
   price        int,
   performance  int,
   attitude     varchar(64),
   environment  varchar(64),
   details      text,

   location     varchar(32),
   website      varchar(128),
   adsite       varchar(128),
   photo        varchar(128),
   email        varchar(128),
   phone1       varchar(16),

   PRIMARY KEY(rid), UNIQUE(pid, mid, review_time), INDEX( pid, mid )
);
