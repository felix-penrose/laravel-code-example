
/**
 * Copy an object without linking the two
 *
 * @param  {obj} obj - the object to copy
 *
 * @return {obj}     - the copied object after converting to a string and back so they're the same but not linked
 */
export function shallow_copy_object(obj)
{
    return JSON.parse(JSON.stringify(obj));
}
