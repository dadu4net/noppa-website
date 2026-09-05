-- Database Schema voor Noppa SSO & Freemium Assessments

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entra_uid VARCHAR(255) NOT NULL UNIQUE,  -- Uniek ID uit Microsoft Entra
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS assessment_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    assessment_type VARCHAR(50) NOT NULL, -- bijv. 'copilot' of 'ai-act'
    status ENUM('free_completed', 'premium_unlocked', 'completed') DEFAULT 'free_completed',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Note: Later kunnen we hier een 'payments' tabel aan toevoegen.
