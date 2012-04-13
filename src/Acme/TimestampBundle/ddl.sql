DROP TABLE timestamps;
CREATE TABLE timestamps (
    id INTEGER NOT NULL,
    col1 TIMESTAMP NOT NULL,
    col2 TIMESTAMP NULL
);
ALTER TABLE timestamps
  ADD CONSTRAINT pk_timestamps
    PRIMARY KEY (id)
;
CREATE SEQUENCE timestamps_id_seq INCREMENT BY 1 MINVALUE 1 START 1;

DROP TABLE timestamps_with_regex;
CREATE TABLE timestamps_with_regex (
    id INTEGER NOT NULL,
    col1 TIMESTAMP NOT NULL,
    col2 TIMESTAMP NULL
);
ALTER TABLE timestamps_with_regex
  ADD CONSTRAINT pk_timestamps_with_regex
    PRIMARY KEY (id)
;
CREATE SEQUENCE timestamps_with_regex_id_seq INCREMENT BY 1 MINVALUE 1 START 1;

DROP TABLE timestamps_with_constraint;
CREATE TABLE timestamps_with_constraint (
    id INTEGER NOT NULL,
    col1 TIMESTAMP NOT NULL,
    col2 TIMESTAMP NULL
);
ALTER TABLE timestamps_with_constraint
  ADD CONSTRAINT pk_timestamps_with_constraint
    PRIMARY KEY (id)
;
CREATE SEQUENCE timestamps_with_constraint_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
