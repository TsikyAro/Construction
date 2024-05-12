CREATE USER construction SUPERUSER LOGIN PASSWORD 'construction';
CREATE DATABASE construction WITH OWNER construction;

CREATE table utilisateur(
    idutilisateur    serial primary key,
    nomUtilisateur  varchar(60),
    mail        varchar(60),
    mdp         varchar(60),
    roles       int -- 0 client 1 admin
);