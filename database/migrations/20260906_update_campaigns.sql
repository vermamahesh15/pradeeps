-- Migration to add en_title, is_primary, sort_order, and category to campaigns table
ALTER TABLE campaigns ADD COLUMN IF NOT EXISTS en_title VARCHAR(190) NULL;
ALTER TABLE campaigns ADD COLUMN IF NOT EXISTS is_primary TINYINT(1) DEFAULT 0;
ALTER TABLE campaigns ADD COLUMN IF NOT EXISTS sort_order INT DEFAULT 0;
ALTER TABLE campaigns ADD COLUMN IF NOT EXISTS category VARCHAR(100) DEFAULT 'unity';
