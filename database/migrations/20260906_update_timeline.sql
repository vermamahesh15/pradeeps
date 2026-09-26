-- Migration to add entry_type, category, and image to timeline table for Seva Yatra and Samman & Puraskar
ALTER TABLE timeline ADD COLUMN IF NOT EXISTS entry_type VARCHAR(50) DEFAULT 'yatra';
ALTER TABLE timeline ADD COLUMN IF NOT EXISTS category VARCHAR(100) DEFAULT 'social';
ALTER TABLE timeline ADD COLUMN IF NOT EXISTS image VARCHAR(255) NULL;
