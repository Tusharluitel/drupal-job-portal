-- Create table for Google Meet interviews
CREATE TABLE IF NOT EXISTS jobportal_interviews (
  iid INT AUTO_INCREMENT PRIMARY KEY,
  sid INT UNSIGNED NOT NULL,
  employer_uid INT UNSIGNED NOT NULL,
  meeting_link VARCHAR(255),
  event_id VARCHAR(255),
  start_time INT UNSIGNED NOT NULL,
  end_time INT UNSIGNED NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'scheduled',
  created INT UNSIGNED NOT NULL,
  INDEX idx_sid (sid),
  INDEX idx_employer_uid (employer_uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores Google Meet interview details';
