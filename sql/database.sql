-- Database: adelyce

-- DROP DATABASE IF EXISTS adelyce;

CREATE DATABASE adelyce
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'French_France.1252'
    LC_CTYPE = 'French_France.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- Table: public.product

-- DROP TABLE IF EXISTS public.product;

CREATE TABLE IF NOT EXISTS public.product
(
    id integer NOT NULL DEFAULT nextval('product_id_sequence'::regclass),
    name character varying(50) COLLATE pg_catalog."default" NOT NULL,
    quantity integer NOT NULL,
    description text COLLATE pg_catalog."default" NOT NULL,
    id_user integer NOT NULL,
    CONSTRAINT product_pkey PRIMARY KEY (id),
    CONSTRAINT id_user FOREIGN KEY (id_user)
        REFERENCES public."user" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.product
    OWNER to postgres;

-- Table: public.share

-- DROP TABLE IF EXISTS public.share;

CREATE TABLE IF NOT EXISTS public.share
(
    id integer NOT NULL DEFAULT nextval('share_id_sequence'::regclass),
    share_to integer NOT NULL,
    id_product integer NOT NULL,
    share_by integer NOT NULL,
    CONSTRAINT share_pkey PRIMARY KEY (id, share_to, id_product, share_by),
    CONSTRAINT id_product FOREIGN KEY (id_product)
        REFERENCES public.product (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT share_by FOREIGN KEY (share_by)
        REFERENCES public."user" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT share_to FOREIGN KEY (share_to)
        REFERENCES public."user" (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID,
    CONSTRAINT different_users CHECK (share_to <> share_by) NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.share
    OWNER to postgres;

-- Table: public.user

-- DROP TABLE IF EXISTS public."user";

CREATE TABLE IF NOT EXISTS public."user"
(
    id integer NOT NULL DEFAULT nextval('user_id_sequence'::regclass),
    email character varying(50) COLLATE pg_catalog."default" NOT NULL,
    lastname character varying(50) COLLATE pg_catalog."default" NOT NULL,
    firstname character varying(50) COLLATE pg_catalog."default" NOT NULL,
    password character varying(100) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT user_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public."user"
    OWNER to postgres;