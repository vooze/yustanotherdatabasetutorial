#!/bin/bash
mysql --local-infile --user=root <<STOP
drop database if exists borrowbase;
create database if not exists borrowbase;
use borrowbase;
/* the datatype serial make an auto increment key type */
create table items ( Item_Id SERIAL, Item_Name Varchar(30));
insert into items (Item_Name)value ("Mouse");
insert into items (Item_Name)value ("2mEtherCable");
insert into items (Item_Name)value ("Keyboard");
insert into items (Item_Name)value ("Raspberry_Pi");
select * from items;
create table borrowers ( Borower_Id SERIAL, Borrower_Name Varchar(30));
insert into borrowers (Borrower_Name)value ("Keld");
insert into borrowers (Borrower_Name)value ("Kaj");
insert into borrowers (Borrower_Name)value ("Knud");
insert into borrowers (Borrower_Name)value ("Knarvorn");
insert into borrowers (Borrower_Name)value ("Karsten");
insert into borrowers (Borrower_Name)value ("Kette");
select * from borrowers;
create table transactions ( Borrower_Id INTEGER, Item_Id INTEGER);
insert into transactions (Borrower_ID,Item_Id)values (1,1);
insert into transactions (Borrower_ID,Item_Id)values (2,2);
insert into transactions (Borrower_ID,Item_Id)values (1,2);
insert into transactions (Borrower_ID,Item_Id)values (1,4);
insert into transactions (Borrower_ID,Item_Id)values (2,4);
insert into transactions (Borrower_ID,Item_Id)values (3,4);
insert into transactions (Borrower_ID,Item_Id)values (4,4);
select * from transactions;
STOP
