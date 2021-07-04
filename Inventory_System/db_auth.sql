--
-- Database: db_auth
--

-- --------------------------------------------------------

--
-- Table structure for table members
--
CREATE DATABASE misc;
CREATE TABLE members (
  member_id int(8) NOT NULL,
  member_name varchar(255) CHARACTER SET utf8 NOT NULL,
  member_password varchar(64) NOT NULL,
  member_email varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table members
--



//Nazmi
//nazmi2021
INSERT INTO members (member_id, member_name, member_password, member_email) VALUES
(1, 'Nazmi', '$2y$12$yEPzSFumODqLyNTB5ykiRe.YdLNEprEKno221O77nmqDPhfWf1lnC ', 'nazmi@gmail.com');


-- --------------------------------------------------------

--
-- Table structure for table tbl_token_auth
--

CREATE TABLE tbl_token_auth (
  id int(11) NOT NULL,
  username varchar(255) NOT NULL,
  password_hash varchar(255) NOT NULL,
  selector_hash varchar(255) NOT NULL,
  is_expired int(11) NOT NULL DEFAULT '0',
  expiry_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table members
--
ALTER TABLE members
  ADD PRIMARY KEY (member_id);

--
-- Indexes for table tbl_token_auth
--
ALTER TABLE tbl_token_auth
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table members
--
ALTER TABLE members
  MODIFY member_id int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table tbl_token_auth
--
ALTER TABLE tbl_token_auth
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;
-- Database Inventory and company

CREATE TABLE INVENTORY(
item_id integer not null AUTO_INCREMENT PRIMARY KEY,
item_name varchar(128),
quantity integer,
price float(10,2),
company_id integer,
    CONSTRAINT FOREIGN KEY (company_id) REFERENCES company (company_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

create table company(
    company_Id integer not null AUTO_INCREMENT PRIMARY KEY,
    company_name varcahr(128),
    address varchar(255),
    tel_num Integer,
    email varchar(128)
    );