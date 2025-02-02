CREATE TABLE IF NOT EXISTS Users (
                                     id SERIAL PRIMARY KEY,
                                     email VARCHAR(255) UNIQUE NOT NULL,
                                     password VARCHAR(255) NOT NULL,
                                     type VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS Hotels (
                                      id SERIAL PRIMARY KEY,
                                      name VARCHAR(255) NOT NULL,
                                      description TEXT,
                                      opinion VARCHAR(10),
                                      location VARCHAR(255),
                                      image VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Rooms (
                                     id SERIAL PRIMARY KEY,
                                     hotel_id INT NOT NULL,
                                     name VARCHAR(255) NOT NULL,
                                     description TEXT,
                                     features TEXT,
                                     gallery TEXT[], -- Array of image paths
                                     FOREIGN KEY (hotel_id) REFERENCES Hotels(id) ON DELETE CASCADE
);

INSERT INTO Users (email, password, type)
VALUES ('admin@domain.com', 'admin', 'admin')
ON CONFLICT (email) DO NOTHING;

INSERT INTO Users (email, password, type)
VALUES ('user@domain.com', 'user', 'user')
ON CONFLICT (email) DO NOTHING;

INSERT INTO Hotels (name, description, opinion, location, image)
VALUES
    ('Hotel 1',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum accumsan mi id accumsan volutpat. Quisque iaculis, sapien molestie rhoncus gravida, turpis purus dapibus nisi, id bibendum arcu nulla vehicula sem. Maecenas aliquam efficitur urna, sed scelerisque sapien tincidunt et. In nisi orci, bibendum ut nisl eu.',
     '5/5',
     'ul. Pawia 27, Warszawa, Polska',
     'hotel-1.jpg')
ON CONFLICT DO NOTHING;

INSERT INTO Hotels (name, description, opinion, location, image)
VALUES
    ('Hotel 2',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum accumsan mi id accumsan volutpat. Quisque iaculis, sapien molestie rhoncus gravida, turpis purus dapibus nisi, id bibendum arcu nulla vehicula sem. Maecenas aliquam efficitur urna, sed scelerisque sapien tincidunt et. In nisi orci, bibendum ut nisl eu.',
     '4/5',
     'ul. Pawia 27, Warszawa, Polska',
     'hotel-2.jpg')
ON CONFLICT DO NOTHING;

INSERT INTO Hotels (name, description, opinion, location, image)
VALUES
    ('Hotel 3',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum accumsan mi id accumsan volutpat. Quisque iaculis, sapien molestie rhoncus gravida, turpis purus dapibus nisi, id bibendum arcu nulla vehicula sem. Maecenas aliquam efficitur urna, sed scelerisque sapien tincidunt et. In nisi orci, bibendum ut nisl eu.',
     '5/5',
     'ul. Pawia 27, Warszawa, Polska',
     'hotel-3.jpg')
ON CONFLICT DO NOTHING;

INSERT INTO Rooms (hotel_id, name, description, features, gallery)
VALUES
    (1,
     'Ocean View Room',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum id justo sollicitudin rutrum. Sed suscipit posuere quam eu lobortis. Nunc vel libero mi.',
     '1 Queen bed, 300 sq. ft., Up to 2 guests, Wi-Fi, TV, air conditioning, Ocean view, Bathroom with shower',
     ARRAY['room-1.jpg', 'room-2.jpg', 'room-3.jpg'])
ON CONFLICT DO NOTHING;

INSERT INTO Rooms (hotel_id, name, description, features, gallery)
VALUES
    (1,
     'Room 2',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum id justo sollicitudin rutrum. Sed suscipit posuere quam eu lobortis. Nunc vel libero mi.',
     '1 Queen bed, 300 sq. ft., Up to 2 guests, Wi-Fi, TV, air conditioning, Ocean view, Bathroom with shower',
     ARRAY['room-1.jpg', 'room-1.jpg', 'room-1.jpg'])
ON CONFLICT DO NOTHING;

INSERT INTO Rooms (hotel_id, name, description, features, gallery)
VALUES
    (1,
     'Room 3',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum id justo sollicitudin rutrum. Sed suscipit posuere quam eu lobortis. Nunc vel libero mi.',
     '1 Queen bed, 300 sq. ft., Up to 2 guests, Wi-Fi, TV, air conditioning, Ocean view, Bathroom with shower',
     ARRAY['room-3.jpg', 'room-3.jpg', 'room-3.jpg'])
ON CONFLICT DO NOTHING;

INSERT INTO Rooms (hotel_id, name, description, features, gallery)
VALUES
    (2,
     'Other Room',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum id justo sollicitudin rutrum. Sed suscipit posuere quam eu lobortis. Nunc vel libero mi.',
     '1 Queen bed, 300 sq. ft., Up to 2 guests, Wi-Fi, TV, air conditioning, Ocean view, Bathroom with shower',
     ARRAY['room-3.jpg', 'room-2.jpg', 'room-1.jpg'])
ON CONFLICT DO NOTHING;

INSERT INTO Rooms (hotel_id, name, description, features, gallery)
VALUES
    (3,
     'What Room',
     'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum id justo sollicitudin rutrum. Sed suscipit posuere quam eu lobortis. Nunc vel libero mi.',
     '1 Queen bed, 300 sq. ft., Up to 2 guests, Wi-Fi, TV, air conditioning, Ocean view, Bathroom with shower',
     ARRAY['room-1.jpg', 'room-1.jpg', 'room-1.jpg'])
ON CONFLICT DO NOTHING;
