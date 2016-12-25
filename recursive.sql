DELIMITER $$

DROP FUNCTION IF EXISTS gm1702848.board_connect;

CREATE FUNCTION  board_connect() RETURNS INT
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE _board_id INT;
    DECLARE _parent_id INT;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET @board_id = NULL;

    SET _parent_id = @board_id;
    SET _board_id = -1;

    IF @board_id IS NULL THEN
        RETURN NULL;
    END IF;

    LOOP
        SELECT  MIN(board_id)
        INTO    @board_id
        FROM    board
        WHERE   parent_id = _parent_id
        AND board_id > _board_id;

        IF @board_id IS NOT NULL OR _parent_id = @start_with THEN
          SET @level = @level + 1;
          RETURN @board_id;
        END IF;

        IF @board_id = _parent_id+1 THEN
          SET @level = @level + 1;
          RETURN @board_id;
        END IF;

        SET @level := @level - 1;

        #board의 board_id와 parent_id select
        SELECT  board_id, parent_id
        INTO    _board_id, _parent_id
        FROM    board
        WHERE   board_id = _parent_id;
    END LOOP;
END

$$

DELIMITER ;


------------------------------------------------------------------------------------------------------------------------


SELECT CONCAT(REPEAT(' RE:', level  - 1), b.title) AS title, b.board_id, b.parent_id, b.writer, b.hit, func.level FROM
(
SELECT board_connect() AS id, @level as level
    FROM    (
        SELECT  @start_with := 0,
                @board_id := @start_with,
                @level := 0
         ) vars, board
          WHERE   @board_id IS NOT NULL
) func
Join board b
ON func.id = b.board_id;
