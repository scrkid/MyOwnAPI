<?php

namespace Anand\Base;

use \Exception;
use \PDO;
use Anand\Vehicle as ChildVehicle;
use Anand\VehicleQuery as ChildVehicleQuery;
use Anand\Map\VehicleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'vehicle' table.
 *
 *
 *
 * @method     ChildVehicleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVehicleQuery orderByName($order = Criteria::ASC) Order by the Name column
 * @method     ChildVehicleQuery orderByColor($order = Criteria::ASC) Order by the Color column
 * @method     ChildVehicleQuery orderByMakeId($order = Criteria::ASC) Order by the Make_id column
 *
 * @method     ChildVehicleQuery groupById() Group by the id column
 * @method     ChildVehicleQuery groupByName() Group by the Name column
 * @method     ChildVehicleQuery groupByColor() Group by the Color column
 * @method     ChildVehicleQuery groupByMakeId() Group by the Make_id column
 *
 * @method     ChildVehicleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVehicleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVehicleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVehicleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVehicleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVehicleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVehicleQuery leftJoinMake($relationAlias = null) Adds a LEFT JOIN clause to the query using the Make relation
 * @method     ChildVehicleQuery rightJoinMake($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Make relation
 * @method     ChildVehicleQuery innerJoinMake($relationAlias = null) Adds a INNER JOIN clause to the query using the Make relation
 *
 * @method     ChildVehicleQuery joinWithMake($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Make relation
 *
 * @method     ChildVehicleQuery leftJoinWithMake() Adds a LEFT JOIN clause and with to the query using the Make relation
 * @method     ChildVehicleQuery rightJoinWithMake() Adds a RIGHT JOIN clause and with to the query using the Make relation
 * @method     ChildVehicleQuery innerJoinWithMake() Adds a INNER JOIN clause and with to the query using the Make relation
 *
 * @method     \Anand\MakeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVehicle findOne(ConnectionInterface $con = null) Return the first ChildVehicle matching the query
 * @method     ChildVehicle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVehicle matching the query, or a new ChildVehicle object populated from the query conditions when no match is found
 *
 * @method     ChildVehicle findOneById(int $id) Return the first ChildVehicle filtered by the id column
 * @method     ChildVehicle findOneByName(string $Name) Return the first ChildVehicle filtered by the Name column
 * @method     ChildVehicle findOneByColor(string $Color) Return the first ChildVehicle filtered by the Color column
 * @method     ChildVehicle findOneByMakeId(int $Make_id) Return the first ChildVehicle filtered by the Make_id column *

 * @method     ChildVehicle requirePk($key, ConnectionInterface $con = null) Return the ChildVehicle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOne(ConnectionInterface $con = null) Return the first ChildVehicle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVehicle requireOneById(int $id) Return the first ChildVehicle filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByName(string $Name) Return the first ChildVehicle filtered by the Name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByColor(string $Color) Return the first ChildVehicle filtered by the Color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByMakeId(int $Make_id) Return the first ChildVehicle filtered by the Make_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVehicle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVehicle objects based on current ModelCriteria
 * @method     ChildVehicle[]|ObjectCollection findById(int $id) Return ChildVehicle objects filtered by the id column
 * @method     ChildVehicle[]|ObjectCollection findByName(string $Name) Return ChildVehicle objects filtered by the Name column
 * @method     ChildVehicle[]|ObjectCollection findByColor(string $Color) Return ChildVehicle objects filtered by the Color column
 * @method     ChildVehicle[]|ObjectCollection findByMakeId(int $Make_id) Return ChildVehicle objects filtered by the Make_id column
 * @method     ChildVehicle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VehicleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Anand\Base\VehicleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Anand\\Vehicle', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVehicleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVehicleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVehicleQuery) {
            return $criteria;
        }
        $query = new ChildVehicleQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildVehicle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VehicleTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VehicleTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVehicle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, Name, Color, Make_id FROM vehicle WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildVehicle $obj */
            $obj = new ChildVehicle();
            $obj->hydrate($row);
            VehicleTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildVehicle|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VehicleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VehicleTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VehicleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VehicleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the Name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE Name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE Name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the Color column
     *
     * Example usage:
     * <code>
     * $query->filterByColor('fooValue');   // WHERE Color = 'fooValue'
     * $query->filterByColor('%fooValue%'); // WHERE Color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $color The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByColor($color = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($color)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $color)) {
                $color = str_replace('*', '%', $color);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_COLOR, $color, $comparison);
    }

    /**
     * Filter the query on the Make_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMakeId(1234); // WHERE Make_id = 1234
     * $query->filterByMakeId(array(12, 34)); // WHERE Make_id IN (12, 34)
     * $query->filterByMakeId(array('min' => 12)); // WHERE Make_id > 12
     * </code>
     *
     * @see       filterByMake()
     *
     * @param     mixed $makeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByMakeId($makeId = null, $comparison = null)
    {
        if (is_array($makeId)) {
            $useMinMax = false;
            if (isset($makeId['min'])) {
                $this->addUsingAlias(VehicleTableMap::COL_MAKE_ID, $makeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($makeId['max'])) {
                $this->addUsingAlias(VehicleTableMap::COL_MAKE_ID, $makeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_MAKE_ID, $makeId, $comparison);
    }

    /**
     * Filter the query by a related \Anand\Make object
     *
     * @param \Anand\Make|ObjectCollection $make The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByMake($make, $comparison = null)
    {
        if ($make instanceof \Anand\Make) {
            return $this
                ->addUsingAlias(VehicleTableMap::COL_MAKE_ID, $make->getId(), $comparison);
        } elseif ($make instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VehicleTableMap::COL_MAKE_ID, $make->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMake() only accepts arguments of type \Anand\Make or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Make relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function joinMake($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Make');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Make');
        }

        return $this;
    }

    /**
     * Use the Make relation Make object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Anand\MakeQuery A secondary query class using the current class as primary query
     */
    public function useMakeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMake($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Make', '\Anand\MakeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVehicle $vehicle Object to remove from the list of results
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function prune($vehicle = null)
    {
        if ($vehicle) {
            $this->addUsingAlias(VehicleTableMap::COL_ID, $vehicle->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vehicle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VehicleTableMap::clearInstancePool();
            VehicleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VehicleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VehicleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VehicleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VehicleQuery
