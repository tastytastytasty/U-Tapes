-- Add missing columns to user table for profile enhancement
-- jenis_kelamin: L (Laki-laki) or P (Perempuan)
-- tanggal_lahir: Date of birth

ALTER TABLE user ADD COLUMN jenis_kelamin CHAR(1) DEFAULT NULL COMMENT 'L=Laki-laki, P=Perempuan' AFTER nama;
ALTER TABLE user ADD COLUMN tanggal_lahir DATE DEFAULT NULL COMMENT 'Tanggal lahir customer' AFTER jenis_kelamin;

-- Note: If columns already exist, you can check with:
-- SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'user' AND TABLE_SCHEMA = 'DATABASE_NAME';
